<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SectionItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SectionItem');
    }

    public function view(AuthUser $authUser, SectionItem $sectionItem): bool
    {
        return $authUser->can('View:SectionItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SectionItem');
    }

    public function update(AuthUser $authUser, SectionItem $sectionItem): bool
    {
        return $authUser->can('Update:SectionItem');
    }

    public function delete(AuthUser $authUser, SectionItem $sectionItem): bool
    {
        return $authUser->can('Delete:SectionItem');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SectionItem');
    }

    public function restore(AuthUser $authUser, SectionItem $sectionItem): bool
    {
        return $authUser->can('Restore:SectionItem');
    }

    public function forceDelete(AuthUser $authUser, SectionItem $sectionItem): bool
    {
        return $authUser->can('ForceDelete:SectionItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SectionItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SectionItem');
    }

    public function replicate(AuthUser $authUser, SectionItem $sectionItem): bool
    {
        return $authUser->can('Replicate:SectionItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SectionItem');
    }

}