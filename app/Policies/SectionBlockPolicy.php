<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SectionBlock;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionBlockPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SectionBlock');
    }

    public function view(AuthUser $authUser, SectionBlock $sectionBlock): bool
    {
        return $authUser->can('View:SectionBlock');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SectionBlock');
    }

    public function update(AuthUser $authUser, SectionBlock $sectionBlock): bool
    {
        return $authUser->can('Update:SectionBlock');
    }

    public function delete(AuthUser $authUser, SectionBlock $sectionBlock): bool
    {
        return $authUser->can('Delete:SectionBlock');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SectionBlock');
    }

    public function restore(AuthUser $authUser, SectionBlock $sectionBlock): bool
    {
        return $authUser->can('Restore:SectionBlock');
    }

    public function forceDelete(AuthUser $authUser, SectionBlock $sectionBlock): bool
    {
        return $authUser->can('ForceDelete:SectionBlock');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SectionBlock');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SectionBlock');
    }

    public function replicate(AuthUser $authUser, SectionBlock $sectionBlock): bool
    {
        return $authUser->can('Replicate:SectionBlock');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SectionBlock');
    }

}