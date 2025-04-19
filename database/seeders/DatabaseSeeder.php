<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\DeliveryMethod;
use App\Models\Language;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $languages = [
            "Slovak",
            "English",
            "Hungarian",
            "Czech"
        ];

        $categories = [
            'Pop',
            'Rock',
            'Blues',
            'Country',
            'Metal',
            'Indie',
            'Hip-Hop',
            'Classical',
            'Punk'
        ];

        // ChatGPT generated albums to seed the database with

        $authors = [
            'Luna Rae',
            'Velvet Neon',
            'Jazzy Skye',
            'Echo Lexi',
            'Nova Bloom',
            'Skylar Vee',
            'Mira Belle',
            'Kandi Rush',
            'Zadie XO',
            'The Stardust Twins',
            'Ava Glitch',
            'Trixie Mirage',
            'Rina Voltage',
            'Sugar Fractals',
            'Gemini Avenue',
            'Lilly Lux',
            'Pink Ritual',
            'Taylor Orbit',
            'Sierra Halo',
            'Revved Up Rituals',
            'The Delta Shakes',
            'Blind Henry Crow',
            'Willie Bones & The Midnight Sons',
            'Tobacco Joe',
            'Jasper "Fretboard" Jones',
            'Lucille & The Lanterns',
            'Smokestack Revival',
            'Ol’ Copper Sam',
            'Maggie Blue',
            'Reverend Hollis Ray',
            'The Hollow Stomp',
            'Levi Clay',
            'Mama Jean & The Soul Rustlers',
            'The Honky Choir',
            'Sweetgrass Revival',
            'Cody Jack & The Backroad Saints',
            'Darla June',
            'Tennessee Flint',
            'The Whiskey Holler',
            'Rhett and the Porchlights',
            'Mason Kline',
            'The Pickin’ Stones',
            'Dixie Laurel',
            'Georgia Kay & Co.',
            'The Fencepost Boys',
            'Sadie Dusk',
            'The Black Maw',
            'Pyre Architect',
            'Screams of Ascent',
            'Nailthrone',
            'Cataclysm Warden',
            'Ashblood Pact',
            'Ritual of Fire',
            'Oblivion Pulse',
            'Tombscript',
            'Sanctum Void',
            'Plague Spiral',
            'Darkwind Tyrant',
            'Indiefield Lane',
            'Theo & The Astronauts',
            'Sunday Pigeons',
            'Fiction Picnic',
            'Flannel Tape',
            'Telescope Forest',
            'The Crooked Frames',
            'Analog Darling',
            'Sleepy Cove',
            'Late Bloomer Parade',
            'Porchlight Scenery',
            'The Plaid Hour',
            'DJ Aftermath Theory',
            'Karma Static',
            'Breeze Tha Sage',
            'The 808 Philosopher',
            'Trap Gatsby',
            'Verse Control',
            'Mighty Echo',
            'Reign Omega',
            'Flow Circuit',
            'Vibe Scholar',
            'Lunar Mic',
            'Hera di Montclair',
            'Sebastian Korr',
            'The Lysander Consort',
            'Teenage Sabotage',
            'The Revolt Tapes',
            'Razor Tactic',
            'Crush the Commute',
            'Vinyl Fury',
            'The Duct Tape Saints',
            'Fast Exit',
            'Caffeine State'
        ];


        $albumTitles = [
            'Glitter Crisis',
            'Neon Hearts and Filtered Regret',
            'Sugar Static',
            'Selfie in Retrograde',
            'Bubblegum After Dark',
            'Digital Daydreams',
            'Pastel Thunder',
            'Crush Algorithm',
            'Midnight Selfies',
            'FOMO & Fireworks',
            'Echo Chamber Love Song',
            'Pixel Hearts',
            'Playlist of Me',
            'Velcro Skies',
            'Mood Ring Forecast',
            'Streaming in Tears',
            'Perfume & Popcorn',
            'Chrome Lullabies',
            'Autotune Diary',
            'Pink Lights, Big Feelings',
            'Thunder in My Coffee',
            'Broken Amp Revival',
            'Grit & Leather',
            'Gasoline Confessions',
            'Echoes of the Basement',
            'Stairwell Saints',
            'Vinyl and Vandalism',
            'Edge of the Overpass',
            'Scarlet Riff',
            'Moonlight Powerchord',
            'Rustbelt Anthem',
            'Concrete Melody',
            'Ashes in Stereo',
            'Smashed & Strung',
            'Roll the Stone Back',
            'Gravel Hearts',
            'Suburbia Rumbles',
            'Band Tee Elegy',
            'Flicker & Feedback',
            'Gutter Serenade',
            'Whiskey Moon Rising',
            'Rust in My Soul',
            'Tears Between Strings',
            'Delta Bones',
            'The Slow Burn Sermon',
            'Lonesome Freight',
            'Rain on Beale Street',
            'Fretboard Memories',
            'Cold Coffee Gospel',
            'Midnight Slide',
            'Echoes in E Minor',
            'Gravel Voice Remedy',
            'Shadows in a Six-String',
            'Crossroad Psalms',
            'Motel Room Blues',
            'Tobacco Heart',
            'Rusty Notes & Long Roads',
            'Train Whistle Farewell',
            'Hard Luck Hymnal',
            'Catfish Soul Revival',
            'Boots, Beers & Broken Promises',
            'Tractor Gospel',
            'Heartbreak Exit 17',
            'Cowboy in the Rearview',
            'Barstool Baptism',
            'Diesel & Dust',
            'Mama’s Porch Light',
            'Friday Night Fencepost',
            'Pickups and Promises',
            'Whiskey-Fueled Hymns',
            'Gravel in My Voice',
            'Backroad Testimony',
            'Shotgun Passenger',
            'Bonfire Prayers',
            'Neon Rodeo',
            'Haybale Moonlight',
            'Plaid Regrets',
            'Two-Step Sorrow',
            'Small Town Ghosts',
            'Pickup Choir',
            'Ashes of the Oath',
            'Infernal Harvest',
            'Wolves of the Furnace',
            'Grave Chorus',
            'Thorns and Thunder',
            'Void of Sovereigns',
            'Rage Upon Ruins',
            'Iron Baptism',
            'The Black Cathedral',
            'Crown of Cinders',
            'Molten Faith',
            'Severed Throne',
            'Sanctum of Suffering',
            'Blood & Boneyards',
            'Rituals of Wreckage',
            'Chained to Chaos',
            'Eclipsed by Fire',
            'Hammer of Hollow Kings',
            'Terror Bloom',
            'Plague of the Serpent God',
            'Cardigan Universe',
            'Cassette Flowers',
            'Lost in the Laundromat',
            'Polaroid Theories',
            'Melancholy for Breakfast',
            'Typewriter Crush',
            'Echoes from Apartment 9B',
            'Cloudy With a Chance of Vinyl',
            'Bike Spokes and Daydreams',
            'Postcard From a Film Festival',
            'Flannel Galaxy',
            'Broken Umbrella Songs',
            'DIY Love Letters',
            'Sad Movie Marathon',
            'Indigo Nostalgia',
            'Graffiti in Slow Motion',
            'Crochet Dreams',
            'Zines & Satellites',
            'Midnight Zookeeper',
            'Subtle Apocalypse',
            'Concrete Verses',
            'Gold Teeth and Ghosts',
            'Midnight Flex',
            'Chillwave Hustle',
            'Zero Chill Dynasty',
            'Echoes of the Cypher',
            'Bluetooth Dreams',
            'Verses in My AirPods',
            'Cipher & Smoke',
            'Platinum Dust',
            'Late Night Legacy',
            'Mic Check My Pulse',
            'Low End Philosophy',
            'Trap Poetry',
            'Vinyl Hustler',
            'Beats in the Rearview',
            'Concrete Sonnets',
            'Headphones & Heartbreak',
            'Underground Royalty',
            'Graffiti Scriptures',
            'Sonata of Shadows',
            'Elegy for an Unread Letter',
            'Baroque Requiem Reimagined',
            'The Opus Machine',
            'Preludes in Dystopia',
            'Moonlight for Machines',
            'Concertos for a Lost Era',
            'Nocturne in Static',
            'Symphony of the Forgotten',
            'Canon for the End Times',
            'Etudes of Silence',
            'Counterpoint Collapse',
            'Midnight Fugue',
            'Aria for a Broken World',
            'Prelude to Solitude',
            'Toccata in Twilight',
            'Suite of Solace',
            'Crescendo of Ash',
            'Tempo Mortale',
            'Minuet in Ashen Light',
            'No Sleep Till Tuesday',
            'Safety Pin Prom',
            'Anarchy in Aisle 4',
            'Dumpster Fire Heart',
            'Static and Spit',
            'Mohawks & Midnight',
            'Rebels Without Wi-Fi',
            'Caffeine and Chainsaws',
            'Pogo Till I Die',
            'Graffiti Gospel',
            'Boredom Riot',
            'Fast Food Revolution',
            'Garage Band Graveyard',
            'Zip Tie Valentine',
            'Punchlines and Protest Signs',
            'Burn the Syllabus',
            'Stage Dive Confessional',
            'No Future in Formalwear',
            'Slacker Hymns',
            'Mosh Pit Benediction'
        ];

        $deliveryMethods = [
            'Standard Post',
            'Courier Service',
            'Express Delivery',
        ];

        $paymentMethods = [
            'Card Online',
            'Upon Delivery',
            'Bank Transfer',
        ];
        foreach ($deliveryMethods as $name) {
            $deliveryMethod = new DeliveryMethod();
            $deliveryMethod->name = $name;
            $deliveryMethod->save();
        }

        foreach ($paymentMethods as $name) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->name = $name;
            $paymentMethod->save();
        }

        foreach ($languages as $name) {
            $language = new Language();
            $language->name = $name;
            $language->save();
        }

        foreach ($categories as $name) {
            $category = new Category();
            $category->name = $name;
            $category->description = fake()->realText(300);
            $category->save();
        }

        foreach ($authors as $name) {
            $author = new Author();
            $author->name = $name;
            $author->save();
        }

        // TODO: Add images
        foreach ($albumTitles as $title) {
            $product = new Product();
            $product->title = $title;
            $product->description = fake()->realText(200);
            $product->release_year = random_int(1950, 2025);
            $product->price = random_int(1000, 4000);

            // Add one to each array index to match row id in database
            $product->language()->associate(array_rand($languages) + 1);
            $product->category()->associate(array_rand($categories) + 1);
            $product->author()->associate(array_rand($authors) + 1);

            $product->save();
        }
    }
}
