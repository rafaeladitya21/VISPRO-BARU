<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EmployeeProfilePhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_form_contains_required_profile_photo_input(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('karyawan.create'));

        $response->assertOk()
            ->assertSee('Foto Profil')
            ->assertSee('name="foto"', false)
            ->assertSee('accept="image/jpeg,image/png,image/webp"', false);
    }

    public function test_employee_profile_photo_is_stored_and_displayed_on_employee_index(): void
    {
        Storage::fake('public');

        $photo = UploadedFile::fake()->createWithContent(
            'profile.png',
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
        );

        $response = $this->actingAs(User::factory()->create())
            ->post(route('karyawan.store'), [
                'nip' => 'VP-099',
                'nama_lengkap' => 'Rafael Aditya',
                'email' => 'rafael@example.com',
                'jabatan' => 'Creative Director',
                'departemen' => 'PHOTOGRAPHER',
                'tanggal_bergabung' => '2026-07-20',
                'foto' => $photo,
            ]);

        $response->assertRedirect(route('karyawan.index'))
            ->assertSessionHasNoErrors();

        $employee = Employee::where('nip', 'VP-099')->firstOrFail();

        $this->assertNotNull($employee->foto);
        Storage::disk('public')->assertExists($employee->foto);

        $this->get(route('karyawan.index'))
            ->assertOk()
            ->assertSee(asset('storage/'.$employee->foto).'?v='.$employee->updated_at->timestamp, false)
            ->assertSee('alt="Rafael Aditya"', false);
    }

    public function test_profile_photo_is_required_when_creating_an_employee(): void
    {
        Storage::fake('public');

        $response = $this->actingAs(User::factory()->create())
            ->post(route('karyawan.store'), [
                'nip' => 'VP-100',
                'nama_lengkap' => 'Tanpa Foto',
                'email' => 'tanpa-foto@example.com',
                'jabatan' => 'Intern',
                'departemen' => 'VIDEO EDITOR',
                'tanggal_bergabung' => '2026-07-20',
            ]);

        $response->assertSessionHasErrors('foto');
        $this->assertDatabaseMissing('employees', ['nip' => 'VP-100']);
    }

    public function test_edit_form_displays_the_current_profile_photo_and_an_optional_replacement_input(): void
    {
        $employee = Employee::create([
            'nip' => 'VP-101',
            'nama_lengkap' => 'Karyawan Edit',
            'email' => 'edit@example.com',
            'jabatan' => 'Production Team',
            'departemen' => 'VIDEOGRAPHER',
            'tanggal_bergabung' => '2026-07-20',
            'foto' => 'foto/current-profile.png',
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('karyawan.edit', $employee));

        $response->assertOk()
            ->assertSee('Ganti Foto Profil')
            ->assertSee('Hapus Foto Profil')
            ->assertSee('name="foto"', false)
            ->assertSee('name="hapus_foto"', false)
            ->assertSee(asset('storage/'.$employee->foto).'?v='.$employee->updated_at->timestamp, false)
            ->assertDontSee('name="foto" required', false);
    }

    public function test_employee_profile_photo_can_be_replaced_during_update(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('foto/old-profile.png', 'old-photo');

        $employee = Employee::create([
            'nip' => 'VP-102',
            'nama_lengkap' => 'Karyawan Update Foto',
            'email' => 'update-foto@example.com',
            'jabatan' => 'Scriptwriter',
            'departemen' => 'CONTENT CREATOR',
            'tanggal_bergabung' => '2026-07-20',
            'foto' => 'foto/old-profile.png',
        ]);

        $newPhoto = UploadedFile::fake()->createWithContent(
            'new-profile.webp',
            base64_decode('UklGRiIAAABXRUJQVlA4IBYAAAAwAQCdASoBAAEAAUAmJaQAA3AA/v89WAAAAA==')
        );

        $response = $this->actingAs(User::factory()->create())
            ->put(route('karyawan.update', $employee), [
                'nip' => $employee->nip,
                'nama_lengkap' => $employee->nama_lengkap,
                'email' => $employee->email,
                'jabatan' => $employee->jabatan,
                'departemen' => $employee->departemen,
                'tanggal_bergabung' => $employee->tanggal_bergabung,
                'foto' => $newPhoto,
            ]);

        $response->assertRedirect(route('karyawan.index'))
            ->assertSessionHasNoErrors();

        $employee->refresh();

        $this->assertNotSame('foto/old-profile.png', $employee->foto);
        Storage::disk('public')->assertExists($employee->foto);
        Storage::disk('public')->assertMissing('foto/old-profile.png');
    }

    public function test_employee_profile_photo_can_be_deleted_during_update(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('foto/profile-to-delete.png', 'profile-photo');

        $employee = Employee::create([
            'nip' => 'VP-104',
            'nama_lengkap' => 'Karyawan Hapus Foto',
            'email' => 'hapus-foto@example.com',
            'jabatan' => 'Production Team',
            'departemen' => 'VIDEOGRAPHER',
            'tanggal_bergabung' => '2026-07-20',
            'foto' => 'foto/profile-to-delete.png',
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->put(route('karyawan.update', $employee), [
                'nip' => $employee->nip,
                'nama_lengkap' => $employee->nama_lengkap,
                'email' => $employee->email,
                'jabatan' => $employee->jabatan,
                'departemen' => $employee->departemen,
                'tanggal_bergabung' => $employee->tanggal_bergabung,
                'hapus_foto' => '1',
            ]);

        $response->assertRedirect(route('karyawan.index'))
            ->assertSessionHasNoErrors();

        $this->assertNull($employee->refresh()->foto);
        Storage::disk('public')->assertMissing('foto/profile-to-delete.png');

        $this->get(route('karyawan.index'))
            ->assertOk()
            ->assertSee('premium-avatar-initial', false)
            ->assertDontSee('profile-to-delete.png');
    }

    public function test_current_profile_photo_is_kept_when_update_has_no_new_photo(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('foto/current-profile.png', 'current-photo');

        $employee = Employee::create([
            'nip' => 'VP-103',
            'nama_lengkap' => 'Karyawan Tanpa Ganti Foto',
            'email' => 'keep-foto@example.com',
            'jabatan' => 'Intern',
            'departemen' => 'VIDEO EDITOR',
            'tanggal_bergabung' => '2026-07-20',
            'foto' => 'foto/current-profile.png',
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->put(route('karyawan.update', $employee), [
                'nip' => $employee->nip,
                'nama_lengkap' => 'Nama Diperbarui',
                'email' => $employee->email,
                'jabatan' => $employee->jabatan,
                'departemen' => $employee->departemen,
                'tanggal_bergabung' => $employee->tanggal_bergabung,
            ]);

        $response->assertRedirect(route('karyawan.index'))
            ->assertSessionHasNoErrors();

        $this->assertSame('foto/current-profile.png', $employee->refresh()->foto);
        Storage::disk('public')->assertExists('foto/current-profile.png');
    }
}
