<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->bootstrapPermissionsBaseline();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Role::query()
            ->whereIn('name', ['panel_user', 'Super Admin', 'Content Admin', 'Editor', 'Viewer', 'Admin'])
            ->where('guard_name', 'web')
            ->delete();

        foreach (['super_admin', 'admin_content', 'editor', 'viewer'] as $roleName) {
            Role::findOrCreate($roleName, 'web');
        }

        $allPermissions = Permission::query()
            ->where('guard_name', 'web')
            ->pluck('name')
            ->all();

        $superAdmin = Role::findByName('super_admin', 'web');
        $superAdmin->syncPermissions($allPermissions);

        $contentAdmin = Role::findByName('admin_content', 'web');
        $contentAdminPermissions = Permission::query()
            ->where('guard_name', 'web')
            ->where('name', 'not like', '%:Role')
            ->where('name', 'not like', '%:User')
            ->pluck('name')
            ->all();
        $contentAdmin->syncPermissions($contentAdminPermissions);

        $editor = Role::findByName('editor', 'web');
        $editorPermissions = Permission::query()
            ->where('guard_name', 'web')
            ->where(function ($query): void {
                $query
                    ->whereIn('name', [
                        'ViewAny:Page', 'View:Page', 'Create:Page', 'Update:Page', 'Reorder:Page', 'Replicate:Page',
                        'ViewAny:SectionBlock', 'View:SectionBlock', 'Create:SectionBlock', 'Update:SectionBlock', 'Reorder:SectionBlock', 'Replicate:SectionBlock',
                        'ViewAny:SectionItem', 'View:SectionItem', 'Create:SectionItem', 'Update:SectionItem', 'Reorder:SectionItem', 'Replicate:SectionItem',
                        'ViewAny:SiteSetting', 'View:SiteSetting', 'Update:SiteSetting',
                        'ViewAny:ContactInquiry', 'View:ContactInquiry', 'Update:ContactInquiry',
                    ]);
            })
            ->pluck('name')
            ->all();
        $editor->syncPermissions($editorPermissions);

        $viewer = Role::findByName('viewer', 'web');

        $viewerPermissions = Permission::query()
            ->where('guard_name', 'web')
            ->where(function ($query): void {
                $query->where('name', 'like', 'View:%')
                    ->orWhere('name', 'like', 'ViewAny:%');
            })
            ->pluck('name')
            ->all();

        $viewer->syncPermissions($viewerPermissions);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    private function bootstrapPermissionsBaseline(): void
    {
        $resources = ['ContactInquiry', 'FooterSetting', 'Page', 'Role', 'SectionBlock', 'SectionItem', 'SiteSetting', 'User'];
        $actions = ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'DeleteAny', 'Restore', 'RestoreAny', 'ForceDelete', 'ForceDeleteAny', 'Replicate', 'Reorder'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::findOrCreate("{$action}:{$resource}", 'web');
            }
        }
    }
}
