<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    protected string $table;
    protected string $types;
    protected string $enable;

    public function __construct()
    {
        $this->table = config('bi-users.account.table', 'accounts');
        $this->types = config('bi-users.account.types', \Bi\Users\Enums\AccountTypeEnum::class);
        $this->enable = config('bi-users.account.enable', 'accounts');
    }

    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->enum('type', $this->types::toArray())->default(collect($this->types::casses())->first()->name)->index();
            $table->uuid('uuid')->unique('unique');
            $table->string('full_name');
            $table->string('username')->unique('username');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
