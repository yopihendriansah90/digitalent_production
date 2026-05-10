<?php

namespace Tests\Feature;

use Database\Seeders\RoleSeeder;
use Database\Seeders\UserRoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolePermissionMatrixTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPermissions();
        $this->seed(RoleSeeder::class);
        $this->seed(UserRoleSeeder::class);
    }

    private function seedPermissions(): void
    {
        $resources = ['ContactInquiry', 'Page', 'Role', 'SectionBlock', 'SectionItem', 'SiteSetting'];
        $actions = ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'DeleteAny', 'Restore', 'RestoreAny', 'ForceDelete', 'ForceDeleteAny', 'Replicate', 'Reorder'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::findOrCreate("{$action}:{$resource}", 'web');
            }
        }
    }

    public function test_viewer_is_read_only(): void
    {
        $viewer = Role::findByName('viewer', 'web');

        $this->assertTrue($viewer->hasPermissionTo('ViewAny:Page'));
        $this->assertTrue($viewer->hasPermissionTo('View:Page'));
        $this->assertFalse($viewer->hasPermissionTo('Create:Page'));
        $this->assertFalse($viewer->hasPermissionTo('Update:Page'));
        $this->assertFalse($viewer->hasPermissionTo('Delete:Page'));
    }

    public function test_editor_has_non_destructive_permissions(): void
    {
        $editor = Role::findByName('editor', 'web');

        $this->assertTrue($editor->hasPermissionTo('Update:Page'));
        $this->assertTrue($editor->hasPermissionTo('Update:SectionBlock'));
        $this->assertTrue($editor->hasPermissionTo('Update:SectionItem'));
        $this->assertFalse($editor->hasPermissionTo('Delete:Page'));
        $this->assertFalse($editor->hasPermissionTo('ForceDelete:SectionBlock'));
    }

    public function test_content_admin_can_manage_content_and_inquiries_but_not_roles(): void
    {
        $contentAdmin = Role::findByName('Admin', 'web');

        $this->assertTrue($contentAdmin->hasPermissionTo('Create:Page'));
        $this->assertTrue($contentAdmin->hasPermissionTo('Delete:SectionItem'));
        $this->assertTrue($contentAdmin->hasPermissionTo('Update:ContactInquiry'));
        $this->assertFalse($contentAdmin->hasPermissionTo('Create:Role'));
        $this->assertFalse($contentAdmin->hasPermissionTo('Delete:Role'));
    }

    public function test_bootstrap_authorization_roles_have_effective_permissions(): void
    {
        $admin = Role::findByName('Admin', 'web');
        $editor = Role::findByName('editor', 'web');
        $viewer = Role::findByName('viewer', 'web');

        $this->assertGreaterThan(0, $admin->permissions()->count());
        $this->assertGreaterThan(0, $editor->permissions()->count());
        $this->assertGreaterThan(0, $viewer->permissions()->count());
    }
}
