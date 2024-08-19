<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\UploadedFile;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\GenresTableSeeder;


class AdminControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // テスト用データのシーディング
        $this->seed(AreasTableSeeder::class);
        $this->seed(GenresTableSeeder::class); // 同様に、GenreSeederも必要に応じて追加
    }

    public function test_userStore()
    {
        $response = $this->post('/userCreate', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', '登録が完了しました。');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);
    }

    public function test_userDelete()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $response = $this->delete('/userDelete/' . $user->id);

        $response->assertRedirect();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_adminUserList()
    {
        User::factory()->count(5)->create();

        $response = $this->get('/adminUserList');

        $response->assertStatus(200);

        $response->assertViewHas('userSearches');

        $users = User::all();
        foreach ($users as $user) {
            $response->assertSee($user->name);
            $response->assertSee($user->email);
        }
    }

    public function test_adminMail()
    {
        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        User::factory()->count(3)->create([
            'role' => 'user',
        ]);

        $response = $this->get('/adminMail');

        $response->assertStatus(200);

        $response->assertViewHas('user');
        $response->assertViewHas('users');

        $response->assertViewHas('users', function ($users) {
            return $users->count() === 3;
        });
    }

    public function test_adminReviewList()
    {
        $shop = Shop::factory()->create([
            'shop_name' => 'Test Shop',
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        Review::factory()->count(5)->create([
            'shop_id' => $shop->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/admin_review_List');

        $response->assertStatus(200);

        $response->assertViewHas('reviews');

        $response->assertViewHas('reviews', function ($reviews) {
            return $reviews->count() === 5;
        });
    }

    public function test_adminReviewDelete()
    {
        $shop = Shop::factory()->create();
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $review = Review::factory()->create([
            'shop_id' => $shop->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->delete('/admin_review_delete' , ['id' => $review->id]);


        $this->assertDatabaseMissing('reviews', [
            'id' => $review->id,
        ]);

        $response->assertRedirect();
    }

    public function test_csvImportShop()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $csvFile = UploadedFile::fake()->create('shops.csv', 100, 'text/csv');

        $csvContent = "店舗名,地域名,ジャンル名,店舗概要,画像URL\n";
        $csvContent .= "Test Shop,東京都,寿司,This is a test shop,https://example.com/image.jpg\n";
        file_put_contents($csvFile->getRealPath(), $csvContent);

        $this->actingAs($user);

        $response = $this->post('/import_shop', [
            'select_user' => $user->id,
            'shop' => $csvFile,
        ]);

        $response->assertSessionHas('success', 'CSVファイルのインポートに成功しました。');


        $this->assertDatabaseHas('shops', [
            'shop_name' => 'Test Shop',
            'content' => 'This is a test shop',
        ]);
    }

    public function test_failure_csvImportShop()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $invalidCsvFile = UploadedFile::fake()->create('invalid_shops.csv', 100, 'text/csv');

        $invalidCsvContent = "shop_name,area_id,genre_id,content,img_path\n";
        $invalidCsvContent .= "Invalid Shop,,,\n";
        file_put_contents($invalidCsvFile->getRealPath(), $invalidCsvContent);

        $this->actingAs($user);

        $response = $this->post('/import_shop', [
            'select_user' => $user->id,
            'shop' => $invalidCsvFile,
        ]);

        $response->assertSessionHas('error', 'インポート中にバリデーションエラーが発生しました。');
        $response->assertSessionHas('validationErrors');
    }
}
