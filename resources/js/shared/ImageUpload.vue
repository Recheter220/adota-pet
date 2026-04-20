<script setup lang="ts">
import Compressor from 'compressorjs';
import { ref, onUnmounted, watch } from 'vue';

const props = defineProps<{
    modelValue: File | File[] | null | undefined;
    multiple?: boolean;
    error?: string;
    label?: string;
    accept?: string;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: File | File[] | null): void;
}>();

const inputRef = ref<HTMLInputElement | null>(null);
const previews = ref<{ url: string; name: string }[]>([]);

const generatePreviews = (files: File | File[] | null | undefined) => {
    // Revoke old previews to avoid memory leaks
    previews.value.forEach((p) => URL.revokeObjectURL(p.url));
    previews.value = [];

    if (!files) {
        return;
    }

    const filesArray = Array.isArray(files) ? files : [files];
    previews.value = filesArray.map((file) => ({
        url: URL.createObjectURL(file),
        name: file.name,
    }));
};

// Watch for external changes to modelValue (e.g. form reset)
watch(
    () => props.modelValue,
    (newValue) => {
        // Only regenerate if the previews count doesn't match or we need to sync
        // For simplicity, we regenerate when modelValue changes from outside
        // But we need to be careful about not breaking the object URL if it's the same file
        // However, File objects are usually new on every selection.
        generatePreviews(newValue);
    },
    { immediate: true },
);

const compressImage = (file: File): Promise<File> => {
    return new Promise((resolve) => {
        new Compressor(file, {
            maxWidth: 800,
            success(result) {
                const compressedFile = new File([result], file.name, {
                    type: result.type,
                    lastModified: Date.now(),
                });
                resolve(compressedFile);
            },
            error(err) {
                console.error('Compression error:', err.message);
                resolve(file);
            },
        });
    });
};

const handleFileChange = async (event: Event) => {
    const target = event.target as HTMLInputElement;
    const files = target.files;

    if (!files || files.length === 0) {
        return;
    }

    const filesArray = Array.from(files);
    const compressedFiles = await Promise.all(filesArray.map(compressImage));

    if (props.multiple) {
        const currentFiles = Array.isArray(props.modelValue)
            ? [...props.modelValue]
            : [];
        const newFiles = [...currentFiles, ...compressedFiles];
        emit('update:modelValue', newFiles);
    } else {
        const file = compressedFiles[0];
        emit('update:modelValue', file);
    }

    // Reset input value so the same file can be selected again if removed
    if (inputRef.value) {
        inputRef.value.value = '';
    }
};

const removeFile = (index: number) => {
    if (props.multiple && Array.isArray(props.modelValue)) {
        const newFiles = [...props.modelValue];
        newFiles.splice(index, 1);
        emit('update:modelValue', newFiles.length > 0 ? newFiles : null);
    } else {
        emit('update:modelValue', null);
    }
};

onUnmounted(() => {
    previews.value.forEach((p) => URL.revokeObjectURL(p.url));
});

const triggerInput = () => {
    inputRef.value?.click();
};
</script>

<template>
    <div class="space-y-2">
        <label v-if="label" class="block text-sm font-medium text-gray-700">
            {{ label }}
        </label>

        <div class="flex flex-wrap gap-4">
            <!-- Previews -->
            <div
                v-for="(preview, index) in previews"
                :key="preview.url"
                class="relative h-24 w-24 overflow-hidden rounded-lg border border-gray-200"
            >
                <img
                    :src="preview.url"
                    class="h-full w-full object-cover"
                    :alt="preview.name"
                />
                <button
                    type="button"
                    @click="removeFile(index)"
                    class="absolute top-1 right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-white hover:bg-red-600 focus:outline-none"
                    title="Remover"
                >
                    <span class="text-xs font-bold">&times;</span>
                </button>
            </div>

            <!-- Upload Button -->
            <button
                v-if="multiple || previews.length === 0"
                type="button"
                @click="triggerInput"
                class="flex h-24 w-24 flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 text-gray-500 hover:border-blue-400 hover:bg-gray-100 focus:outline-none"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-8 w-8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>
                <span class="mt-1 text-xs">Adicionar</span>
            </button>
        </div>

        <input
            ref="inputRef"
            type="file"
            class="hidden"
            :multiple="multiple"
            :accept="accept || 'image/*'"
            @change="handleFileChange"
        />

        <div v-if="error" class="mt-1 text-sm text-red-500">
            {{ error }}
        </div>
    </div>
</template>
