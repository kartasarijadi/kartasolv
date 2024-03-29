<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @testdox TS-00 Cek fungsi log in
 */
class Scenario00Test extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;
    protected $sessionData, $um, $tc;
    protected function setUp(): void
    {
        parent::setUp();
        $this->um = new \App\Models\UsersModel();
        $this->sessionData = [
            'user' => objectify([
                'userId' => 2,
                'roleId' => 1,
                'roleString' => 'admin',
                'roleName' => 'Administrator',
            ])
        ];
        $this->tc = [
            'test_scenario' => 'Cek fungsi log in',
            'scenario' => 'TS-00',
            'case_code' => '',
            'case' => '',
            'step' => [],
            'data' => [],
            'expected' => '',
            'actual' => ''
        ];
        $this->tc['step'][] = "Masuk ke halaman 'Masuk'";
        $result = $this->call('get', "masuk");
        $result->assertOK();
        $result->assertSee('Masuk', 'h1');
        $result->assertSeeElement('input[name=user_email]');
        $result->assertSeeElement('input[name=user_password]');
    }

    /**
     * @uses \Config\Services
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        if (!isset($_SESSION))
            session_start();
        if (session_status() === PHP_SESSION_ACTIVE)
            session_destroy();
        \Config\Services::validation()->reset();
        parseTest($this->tc);
        $this->assertTrue($this->tc['expected'] === $this->tc['actual'], "expected: " . $this->tc['expected'] . "\n" . 'actual: ' . $this->tc['actual']);
    }

    /**
     * @testdox TC-01 Masuk dengan enkripsi kata sandi MD5
     */
    public function testLoginMD5()
    {
        $this->tc['case_code'] = 'TC-01';
        $this->tc['case'] = 'Masuk dengan enkripsi kata sandi MD5';
        $this->tc['expected'] = "Diarahkan ke halaman " . base_url('dasbor');
        $data = [
            'user_id' => 2,
            'user_password' => 'e16b2ab8d12314bf4efbd6203906ea6c'
        ];
        $this->um->save($data);
        $this->tc['step'][] =  "Menyimpan kata sandi enkripsi MD5 pada basis data";
        $this->tc['step'][] =  "Masukkan data email dan kata sandi";
        $this->tc['data'][] = "user_email: test@test.com";
        $this->tc['data'][] = "user_password: testpassword";
        $this->tc['step'][] =  "Menekan tombol 'Masuk'";
        $result = $this->call('post', 'masuk', [csrf_token() => csrf_hash(), 'user_email' => 'test@test.com', 'user_password' => 'testpassword', 'g-recaptcha-response' => 'random-token']);
        $result->assertRedirectTo(base_url('dasbor'));
        $this->tc['actual'] = "Diarahkan ke halaman " . $result->getRedirectUrl();
    }

    /**
     * @testdox TC-02 Masuk dengan enkripsi kata sandi KartaSarijadi
     */
    public function testLoginKartaSarijadiEncrypt()
    {
        $this->tc['case_code'] = 'TC-02';
        $this->tc['case'] = 'Masuk dengan enkripsi kata sandi KartaSarijadi';
        $this->tc['expected'] = "Diarahkan ke halaman " . base_url('dasbor');
        $this->tc['step'][] =  "Masukkan data email dan kata sandi";
        $this->tc['data'][] = "user_email: test@test.com";
        $this->tc['data'][] = "user_password: testpassword";
        $this->tc['step'][] =  "Menekan tombol 'Masuk'";
        $result = $this->call('post', 'masuk', [csrf_token() => csrf_hash(), 'user_email' => 'test@test.com', 'user_password' => 'testpassword', 'g-recaptcha-response' => 'random-token']);
        $result->assertRedirectTo(base_url('dasbor'));
        $this->tc['actual'] = "Diarahkan ke halaman " . $result->getRedirectUrl();
    }

    /**
     * @testdox TC-03 Masuk dengan kata sandi yang salah
     */
    public function testFalseCredentials()
    {
        $this->tc['case_code'] = 'TC-03';
        $this->tc['case'] = 'Masuk dengan kata sandi yang salah';
        $this->tc['expected'] = "Diarahkan ke halaman " . base_url('masuk') . ' dan menampilkan pesan Email atau Kata Sandi Salah!';
        $this->tc['step'][] =  "Masukkan data email dan kata sandi";
        $this->tc['data'][] = "user_email: test@test.com";
        $this->tc['data'][] = "user_password: wrongpassword";
        $this->tc['step'][] =  "Menekan tombol 'Masuk'";
        $result = $this->call('post', 'masuk', [csrf_token() => csrf_hash(), 'user_email' => 'test@test.com', 'user_password' => 'wrongpassword', 'g-recaptcha-response' => 'random-token']);
        $message = getFlash('message', true);
        $result->assertRedirectTo(base_url('masuk'));
        $result->assertSessionHas('message', 'Email atau Kata Sandi Salah!');
        $flash = getFlash('message');
        $result->assertEquals("<div class='alert alert-danger alert-dismissible fade show' role='alert'>$message<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>", $flash, $flash);
        $this->tc['actual'] = "Diarahkan ke halaman " . $result->getRedirectUrl() . " dan menampilkan pesan $message";
    }

    /**
     * @testdox TC-04 Masuk dengan gagal validasi email
     */
    public function testFalseInput()
    {
        $this->tc['case_code'] = 'TC-04';
        $this->tc['case'] = 'Masuk dengan gagal validasi email';
        $this->tc['expected'] = "Diarahkan ke halaman " . base_url('masuk') . ' dan menampilkan pesan Kolom Email harus berisi sebuah alamat surel yang valid.';
        $this->tc['step'][] =  "Masukkan data email dan kata sandi";
        $this->tc['data'][] = "user_email: a b c d e";
        $this->tc['data'][] = "user_password: wrongpassword";
        $this->tc['step'][] =  "Menekan tombol 'Masuk'";
        $result = $this->call('post', 'masuk', [csrf_token() => csrf_hash(), 'user_email' => 'a b c d e', 'user_password' => 'wrongpassword', 'g-recaptcha-response' => 'random-token']);
        $validationError = service('validation')->getError('user_email');
        $result->assertRedirectTo(base_url('masuk'));
        $result->isTrue($validationError === "Kolom Email harus berisi sebuah alamat surel yang valid.", $validationError);
        $this->tc['actual'] = "Diarahkan ke halaman " . $result->getRedirectUrl() . ' dan menampilkan pesan ' . $validationError;
    }

    /**
     * @testdox TC-05 Pergi ke halaman Masuk ketika sudah ada session
     */
    public function testAccessLoginPageAfterSessionIsSet()
    {
        $this->tc['case_code'] = 'TC-05';
        $this->tc['case'] = 'Pergi ke halaman Masuk ketika sudah ada session';
        $this->tc['expected'] = "Diarahkan ke halaman " . base_url('dasbor');
        $this->tc['step'] =  [
            "Masuk ke halaman dasbor",
            "Mencoba masuk ke halaman login"
        ];
        $result = $this->withSession($this->sessionData)->call('get', "masuk");
        $result->assertOK();
        $result->assertRedirectTo(base_url('dasbor'));
        $this->tc['actual'] = "Diarahkan ke halaman " . $result->getRedirectUrl();
    }

    /**
     * @testdox TC-06 Melakukan aksi keluar
     */
    public function testLogout()
    {
        $this->tc['case_code'] = 'TC-06';
        $this->tc['case'] = 'Melakukan aksi keluar';
        $this->tc['expected'] = "Diarahkan ke halaman " . base_url('masuk');
        $this->tc['step'] =
            [
                "Masuk ke halaman dasbor",
                "Menekan tombol keluar"
            ];
        $result = $this->withHeaders([
            "Content-Type" => 'multipart/form-data'
        ])->withRoutes([
            ['post', 'keluar', 'Auth::index'],
        ])->withSession($this->sessionData)->call('post', "keluar", ['_method' => "DELETE", csrf_token() => csrf_hash(), 'g-recaptcha-response' => 'random-token']);
        $result->assertOK();
        $result->assertRedirectTo(base_url('masuk'));
        $this->tc['actual'] = "Diarahkan ke halaman " . $result->getRedirectUrl();
    }

    /**
     * @testdox TC-07 Masuk ke dasbor tanpa ada sesi aktif
     */
    public function testRestrictAccessIfNotLoggedIn()
    {
        $this->tc['case_code'] = 'TC-07';
        $this->tc['case'] = 'Masuk ke dasbor tanpa ada sesi aktif';
        $this->tc['expected'] = "Menampilkan pesan Kamu tidak dapat mengakses halaman tersebut!";
        $this->tc['step'] =  ["Masuk ke halaman dasbor"];

        $result = $this->call('get', "dasbor");
        $result->assertOK();
        $result->assertSessionHas('message', 'Kamu tidak dapat mengakses halaman tersebut!');
        $result->assertRedirectTo(base_url('masuk'));
        $this->tc['actual'] = "Menampilkan pesan " . getFlash('message', true);
    }

    /**
     * @testdox TC-08 Akses gambar privat tidak ditemukan
     */
    public function testPrivateImageNotFound()
    {
        $this->tc['case_code'] = 'TC-08';
        $this->tc['case'] = 'Akses gambar privat tidak ditemukan';
        $this->tc['expected'] = "Menampilkan pesan Halaman Tidak Ditemukan";
        $this->tc['step'] =  ["Masuk ke halaman Gambar Privat"];
        $this->tc['data'] =  ["q: notfound.webp"];
        try {
            $sessionData = [
                'user' => objectify([
                    'userId' => 2,
                    'roleId' => 1,
                    'roleString' => 'admin',
                    'roleName' => 'Administrator',
                ])
            ];
            $this->withSession($sessionData)->call('get', 'gambar-privat?q=notfound.webp');
        } catch (\CodeIgniter\Exceptions\PageNotFoundException $e) {
            $message = $e->getMessage();
        }
        $this->tc['actual'] = "Menampilkan pesan $message";
    }

    /**
     * @testdox TC-09 Akses gambar privat
     */
    public function testLoadPrivateImages()
    {
        $this->tc['case_code'] = 'TC-09';
        $this->tc['case'] = 'Akses gambar privat';
        $this->tc['expected'] = "Mendapatkan header dengan tipe image/webp";
        $this->tc['step'] =  ["Masuk ke halaman Gambar Privat"];
        $this->tc['data'] =  ["q: default.webp"];
        $result = $this->withSession($this->sessionData)->call('get', "gambar-privat?", ['q' => 'uploads/default.webp']);
        $result->assertOK();
        $result->assertHeader('Content-Type', 'image/webp; charset=UTF-8');
        $this->tc['actual'] = "Mendapatkan header dengan tipe image/webp";
    }

    /**
     * @testdox TC-10 Akses gambar privat dengan mencoba akses direktori terkunci
     */
    public function testRestrictAccessingPrivateDirectory()
    {
        $this->tc['case_code'] = 'TC-10';
        $this->tc['case'] = 'Akses gambar privat dengan mencoba akses direktori terkunci';
        $this->tc['expected'] = "Diarahkan ke halaman " . base_url('gambar-privat?q=%2fuploads%2fdefault.webp');
        $this->tc['step'] =  ["Masuk ke halaman Gambar Privat"];
        $this->tc['data'] =  ["q: ../../uploads/default.webp"];
        $result = $this->withSession($this->sessionData)->call('get', "gambar-privat?", ['q' => '../../uploads/default.webp']);
        $result->assertOK();
        $result->assertRedirectTo(base_url('gambar-privat?q=%2fuploads%2fdefault.webp'));
        $this->tc['actual'] = "Diarahkan ke halaman " . $result->getRedirectUrl();
    }
}
