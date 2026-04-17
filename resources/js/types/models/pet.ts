import type { Organization } from "./organization";
import type { PetGallery } from "./pet-gallery";

export type Pet = {
    id: number;
    organization_id: number;
    organization: Organization;
    name: string;
    species: string;
    gender: string;
    breed: string;
    color: string;
    birthday: string;
    bio: string;
    gallery: PetGallery[];
    picture: string;
    created_at: string;
    updated_at: string;
    deleted_at: string;
}
