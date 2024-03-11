<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Genders;
use App\Models\User;
use App\Models\UserTypes;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    // set this variable to `false` if you don't want to add dummy data to the database
    const GENERATE_DUMMY_DATA = true;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Creating Provinces.................');
        // populate country database
        DB::statement("
            INSERT IGNORE INTO provinces(province) VALUES
                ('COAST'),
                ('NORTH EASTERN'),
                ('EASTERN'),
                ('CENTRAL'),
                ('RIFTVALLEY'),
                ('WESTERN'),
                ('NYANZA'),
                ('NAIROBI')");
        $this->command->info('Creating Counties.................');
        DB::statement("
            INSERT IGNORE INTO counties(county, province_id) VALUES
                ('MOMBASA', 1),
                ('KWALE', 1),
                ('KILIFI', 1),
                ('TANA RIVER', 1),
                ('LAMU', 1),
                ('TAITA TAVETA', 1),
                ('GARISSA', 2),
                ('WAJIR', 2),
                ('MANDERA', 2),
                ( 'MARSABIT', 3),
                ( 'ISIOLO', 3),
                ( 'MERU', 3),
                ( 'THARAKA-NITHI', 3),
                ( 'EMBU', 3),
                ( 'KITUI', 3),
                ( 'MACHAKOS', 3),
                ('MAKUENI', 3),
                ('NYANDARUA', 4),
                ('NYERI', 4),
                ('KIRINYAGA', 4),
                ('MURANG\'A', 4),
                ('KIAMBU', 4),
                ('TURKANA', 5),
                ('WEST POKOT', 5),
                ('SAMBURU', 5),
                ('TRANS-NZOIA', 5),
                ('UASING GISHU', 5),
                ('ELGEYO-MARAKWET', 5),
                ('NANDI', 5),
                ('BARINGO', 5),
                ('LAIKIPIA', 5),
                ('NAKURU', 5),
                ('NAROK', 5),
                ('KAJIADO', 5),
                ('KERICHO', 5),
                ('BOMET', 5),
                ('KAKAMEGA', 6),
                ('VIGIA', 6),
                ('BUNGOMA', 6),
                ('BUSIA', 6),
                ('SIAYA', 7),
                ('KISUMU', 7),
                ('HOMABAY', 7),
                ('MIGORI', 7),
                ('KISII', 7),
                ('NYAMIRA', 7),
                ('NAIROBI', 8)");
        $this->command->info('Creating Constituencies.................');
        DB::statement("
            INSERT IGNORE INTO constituencies(constituency, county_id) VALUES
                -- Coast
                ('CHANGAMWE', 1), ('JOMVU', 1), ('KISAUNI', 1), ('NYALI', 1), ('LIKONI', 1), ('MVITA', 1),
                ('MSAMBWENI', 2), ('LUNGA LUNGA', 2), ('MATUGA', 2), ('KINANGO', 2),
                ('KILIFI NORTH', 3), ('KILIFI SOUTH', 3), ('KALOLENI', 3), ('RABAI', 3), ('GANZE', 3), ('MALINDI', 3), ('MAGARINI', 3),
                ('GARSEN', 4), ('GALOLE', 4), ('BURA', 4),
                ('''LAMU EAST', 5), ('LAMU WEST', 5),
                ('TAVETA', 6), ('WUNDANYI', 6), ('MWATATE', 6), ('VOI', 6),
                -- North Eastern
                ('GARISSA TOWNSHIP', 7), ('BALAMBALA', 7), ('LAGDERA', 7), ('DABAAB', 7), ('FAFI', 7), ('IJARA', 7),
                ('WAJIR NORTH', 8), ('WAJIR EAST', 8), ('TARBAJ', 8), ('WAJIR WEST', 8), ('ELDAS', 8), ('WAJIR SOUTH', 8),
                ('MANDERA WEST', 9), ('BANISSA', 9), ('MANDERA NORTH', 9), ('MANDERA SOUTH', 9), ('MANDERA EAST', 9), ('LAFEY', 9),
                -- Eastern
                ('MOYALE', 10), ('NORTH HORR', 10), ('SAKU', 10), ('LAISAMIS', 10),
                ('ISIOLO NORTH', 11), ('ISIOLO SOUTH', 11),
                ('IGEMBE SOUTH', 12), ('IGEMBE CENTRAL', 12), ('IGEMBE NORTH', 12), ('TIGANIA WEST', 12), ('TIGANIA EAST', 12), ('NORTH IMENTI', 12), ('BUURI', 12), ('CENTRAL IMENTI', 12), ('SOUTH IMENTI', 12),
                ('MAARA', 13), ('CHUKA', 13), ('THARAKA', 13),
                ('MANYATTA', 14), ('RUNYENJES', 14), ('MBEERE SOUTH', 14), ('MBEERE NORTH', 14),
                ('MWINGI NORTH', 15), ('MWINGI WEST', 15), ('MWINGI CENTRAL', 15), ('KITUI WEST', 15), ('KITUI RURAL', 15), ('KITUI CENTRAL', 15), ('KITUI EAST', 15), ('KITUI SOUTH', 15),
                ('MASINGA', 16), ('YATTA', 16), ('KANGUNDO', 16),('MATUNGULU', 16), ('KATHIANI', 16), ('MAVOKO', 16), ('MACHAKOS TOWN', 16), ('MWALA', 16),
                ('MBOONI', 17), ('KILOME', 17), ('KAITI', 17), ('MAKUENI', 17), ('KIBWEZI WEST', 17), ('KIBWEZI EAST', 17),
                -- Central
                ('KINANGOP', 18), ('KIPIPIRI', 18), ('OL KALOU', 18), ('OL JOROK', 18), ('NDARAGWA', 18),
                ('TETU', 19), ('KIENI', 19), ('MATHIRA', 19), ('OTHAYA', 19), ('MUKURWENI', 19), ('NYERI TOWN', 19),
                ('MWEA', 20), ('GICHUGU', 20), ('NDIA', 20), ('KIRINYAGA CENTRAL', 20),
                ('KANGEMA', 21), ('MATHIOYA', 21), ('KIHARU', 21), ('KIGUMO', 21), ('MARAGWA', 21), ('KANDARA', 21), ('GATANGA', 21),
                ('GATUNDU SOUTH', 22), ('GATUNDU NORTH', 22), ('JUJA', 22), ('THIKA TOWN', 22), ('RUIRU', 22), ('GITHUNGURI', 22), ('KIAMBU', 22), ('KIAMBAA', 22), ('KABETE', 22), ('KIKUYU', 22), ('LIMURU', 22), ('LARI', 22),
                -- Rift Valley
                ('TURKANA NORTH', 23), ('TURKANA WEST', 23), ('TURKANA CENTRAL', 23), ('LOIMA', 23), ('TURKANA SOUTH', 23), ('TURKANA EAST', 23),
                ('KAPENGURIA', 24), ('SIGOR', 24), ('KACHELIBA', 24), ('POKOT SOUTH', 24),
                ('SAMBURU WEST', 25), ('SAMBURU NORTH', 25), ('SAMBURU EAST', 25),
                ('KWANZA', 26), ('ENDEBESS', 26), ('SABOTI', 26), ('KIMININI', 26), ('CHERANGANY', 26),
                ('SOY', 27), ('TURBO', 27), ('MOIBEN', 27), ('AINABKOI', 27), ('KAPSERET', 27), ('KESSES', 27),
                ('MARAKWET EAST', 28), ('MARAKWET WEST', 28), ('KEIYO NORTH', 28), ('KEIYO SOUTH', 28),
                ('TINDERET', 29), ('ALDAI', 29), ('NANDI HILL', 29), ('CHESUMEI', 29), ('EMGWEN', 29), ('MOSOP', 29),
                ('TIATY', 30), ('BARINGO NORTH', 30), ('BARINGO CENTRAL', 30), ('BARINGO SOUTH', 30), ('MOGOTIO', 30), ('ELDAMA RAVINE', 30),
                ('LAIKIPIA WEST', 31), ('LAIKIPIA EAST', 31), ('LAIKIPIA NORTH', 31),
                ('MOLO', 32), ('NJORO', 32), ('NAIVASHA', 32), ('GILGIL', 32), ('KURESOI SOUTH', 32), ('KURESOI NORTH', 32), ('SUBUKIA', 32), ('RONGAI', 32), ('BAHATI', 32), ('NAKURU TOWN WEST', 32), ('NAKURU TOWN WEST', 32),
                ('KILGORIS', 33), ('EMURUA DIKIRR', 33), ('NAROK NORTH', 33), ('NAROK EAST', 33), ('NAROK SOUTH', 33), ('NAROK WEST', 33),
                ('KAJIADO NORTH', 34), ('KAJIADO CENTRAL', 34), ('KAJIADO EAST', 34), ('KAJIADO WEST', 34), ('KAJIADO SOUTH', 34),
                ('KIPKELION EAST', 35), ('KIPKELION WEST', 35), ('AINAMOI', 35), ('BURETI', 35), ('BELGUT', 35), ('SIGOWET-SION', 35),
                ('SOTIK', 36), ('CHEPALUNGU', 36), ('BOMET EAST', 36), ('BOMET CENTRAL', 36), ('KONI', 36),
                -- Western
                ('LUGARI', 37), ('LIKUYANI', 37), ('MALAVA', 37), ('LURAMBI', 37), ('NAVAKHOLO', 37), ('MUMIAS WEST', 37), ('MUMIAS EAST', 37), ('MATUNGU', 37), ('BUTERE', 37), ('KWISERO', 37), ('SHINYALU', 37), ('IKOLOMANI', 37),
                ('VIHIGA', 38), ('SABATIA', 38), ('HAMISI', 38), ('LUANDA', 38), ('EMUHAYA', 38),
                ('MOUNT ELGON', 39), ('SIRISIA', 39), ('KABUCHAI', 39), ('BUMULA', 39), ('KANDUYI', 39), ('WEBUYE EAST', 39), ('WEBUYE WEST', 39), ('KIMILILI', 39), ('TONGAREN', 39),
                ('TESO NORTH', 40), ('TESO SOUTH', 40), ('NAMBALE', 40), ('MATAYOS', 40), ('BUTULA', 40), ('FUNYULA', 40), ('BUDALANGI', 40),
                -- Nyanza
                ('UGENYA', 41), ('UGUNJA', 41), ('ALEGO USONGA', 41), ('GEM', 41), ('BONDO', 41), ('RARIEDA', 41),
                ('KISUMU EAST', 42), ('KISUMU WEST', 42), ('KISUMU CENTRAL', 42), ('SEME', 42), ('NYANDO', 42), ('MUHORONI', 42), ('NYAKACH', 42),
                ('KASIPUL', 43), ('KABONDO KASIPUL', 43), ('KARACHUONYO', 43), ('RANGWE', 43), ('HOMABAY TOWN', 43), ('NDHIWA', 43), ('MBITA', 43), ('SUBA', 43),
                ('RONGO', 44), ('AWENDO', 44), ('SUNA EAST', 44), ('SUNA WEST', 44), ('URIRI', 44), ('NYATIKE', 44), ('KURIA WEST', 44), ('KURIA EAST', 44),
                ('BONCHARI', 45), ('SOUTH MUGIRANGO', 45), ('BOMACHOGE BORABU', 45), ('BOBASI', 45), ('BOMACHOGE CHACHE', 45), ('NYARIBARI MASABA', 45), ('NYARIBARI CHACHE', 45), ('KITUTU CHACHE NORTH', 45), ('KITUTU CHACHE SOUTH', 45),
                ('KITUTU MASABA', 46), ('WEST MUGIRANGO', 46), ('NORTH MUGIRANGO', 46), ('BORABU', 46),
                --  Nairobi
                ('WESTLANDS', 47), ('DAGORETI NORTH', 47), ('DAGORETI SOUTH', 47), ('LANG\'ATA', 47), ('KIBRA', 47), ('ROYSAMBU', 47), ('KASARANI', 47), ('RUARAKA', 47), ('EMBAKASI SOUTH', 47), ('EMBAKASI NORTH', 47), ('EMBAKASI CENTRAL', 47), ('EMBAKASI EAST', 47), ('EMBAKASI WEST', 47), ('MAKADARA', 47), ('KAMUKUNJI', 47), ('STAREHE', 47), ('MATHARE', 47)
            ");
        // Create genders
        $this->command->info('Creating Genders.................');
        Genders::create([
            "gender" => "MALE",
        ]);
        Genders::create([
            "gender" => "FEMALE",
        ]);

        // Create user types
        $this->command->info('Creating Default User Types.................');
        UserTypes::create([
            "user_type" => "ADMIN",
        ]);
        UserTypes::create([
            "user_type" => "VOTER",
        ]);

        // Create admin user
        $this->command->info('Creating Default Users.................');
        User::create([
            "first_name" => "Admin",
            "last_name" => "Admin",
            "password" => bcrypt("Admin123."),
            "user_type_id" => 1,
            "phone" => "0700000000",
            "email" => "admin@account.com",
            "dob" => "2000-10-23",
            "ward" => "KASARANI",
        ]);
        // Create a normal user
        User::create([
            "first_name" => "Voter",
            "last_name" => "User",
            "password" => bcrypt("User123."),
            "phone" => "0711111111",
            "email" => "voter@account.com",
            "dob" => "2000-10-23",
            "ward" => "KASARANI",
        ]);
        // Create Dummy Users
        if (self::GENERATE_DUMMY_DATA) {
            $this->command->info('Creating Dummy Users.................');
            UserFactory::new()->count(50)->create();
        }
    }
}
