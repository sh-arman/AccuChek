<?php

namespace App\Console\Commands;

use App\Models\Code;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerateCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panacea:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates unique verification codes and stores on the database';

    /**
     * Execute the console command.
     */
    public function handle() {

        $quantity = 0;
        $availableCodeCount = DB::table('codes')->where( 'status', '=', '0' )->count();

        if ( $availableCodeCount <= 2000000 ) {
            $quantity = 5000;
            // $quantity = 1000000;
        } elseif( $availableCodeCount >= 5000000 ){
            $quantity = 0;
            // $quantity = 100;
            // $quantity = 500;
        } else {
            $quantity = 0;
            // $quantity = 50;
            // $quantity = 20000;
        }

        for ( $i = 0; $i < $quantity; $i++ )
        {
            try {
                DB::table('codes')->insert(
                    [ 'code' => $this->generateCode() ]
                );
                // $data = [ 'code' => $this->generateCode() ];
                // Code::create( $data );
                // Log::info("Code added");
            } catch ( \Illuminate\Database\QueryException $e ) {
                Log::info("Code Generate Error from Console corn job:". $e->getMessage());
                continue;
            }
        }
        // $this->info( "Code generation successful!" );
        // Log::info( "Codes generated!" );
    }

    /**
     * Generates random codes
     */
    private function generateCode() {
        $an = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $su = strlen( $an ) - 1;
        return $generatedString =
        substr( $an, rand( 0, $su ), 1 ) .
        substr( $an, rand( 0, $su ), 1 ) .
        substr( $an, rand( 0, $su ), 1 ) .
        substr( $an, rand( 0, $su ), 1 ) .
        substr( $an, rand( 0, $su ), 1 ) .
        substr( $an, rand( 0, $su ), 1 ) .
        substr( $an, rand( 0, $su ), 1 );
        // return $generatedString;
    }
}
