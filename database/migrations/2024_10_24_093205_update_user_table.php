<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->after('nom');
            $table->date('date_naissance')->nullable()->after('email');
            $table->string('carte_identite')->nullable()->after('date_naissance');
            $table->string('localisation')->nullable()->after('carte_identite');
            $table->string('telephone')->nullable()->after('localisation');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'date_naissance', 'carte_identite', 'localisation', 'telephone']);
        });
    }
};
