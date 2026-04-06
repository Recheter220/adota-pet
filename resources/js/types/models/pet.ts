import type { Organization } from "./organization";

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
    picture: string;
    created_at: string;
    updated_at: string;
    deleted_at: string;
}
