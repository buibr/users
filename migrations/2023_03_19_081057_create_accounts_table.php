<?php

use Bi\Users\Enums\AccountTypeEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    protected string $table;

    public function __construct()
    {
        $this->table = config('bi-accounts.table', 'accounts');
    }

    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->enum('type', AccountTypeEnum::toArray())->default(AccountTypeEnum::USER->name)->index();
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
