<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                @layer theme{...} /* hier blijft jouw bestaande Tailwind CSS staan, niks aanpassen */
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Registreren
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

        {{-- MAIN CONTENT --}}
        <main class="w-full lg:max-w-4xl max-w-[335px] bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] overflow-hidden flex flex-col lg:flex-row">
            {{-- Afbeelding --}}
            <div class="lg:w-[438px] w-full bg-[#dbdbd7] dark:bg-[#3E3E3A] flex items-center justify-center p-6 lg:p-8">
                <img
                    src="data:image/jpeg;base64,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"
                    alt="SmilePro afbeelding"
                    class="max-w-[335px] lg:max-w-none rounded-lg shadow-[0px_0px_1px_0px_rgba(0,0,0,0.08),0px_4px_8px_0px_rgba(0,0,0,0.12)]"
                />
            </div>

            {{-- Tekst over SmilePro --}}
            <section class="flex-1 p-6 lg:p-8 flex flex-col justify-center gap-4">
                <h1 class="text-2xl font-medium mb-2 dark:text-[#EDEDEC]">
                    Welkom bij <span class="text-[#f53003] dark:text-[#FF4433]">SmilePro</span>
                </h1>

                <p class="text-sm leading-normal text-[#706f6c] dark:text-[#A1A09A]">
                    SmilePro is jouw digitale omgeving voor een gezonde, stralende glimlach. 
                    Via dit portaal kun je veilig inloggen, je gegevens beheren en eenvoudig afspraken
                    inplannen bij jouw praktijk.
                </p>

                <p class="text-sm leading-normal text-[#706f6c] dark:text-[#A1A09A]">
                    Ben je al klant? Log dan in om je aankomende afspraken te bekijken of een nieuwe
                    afspraak te plannen. Nieuw bij SmilePro? Maak eerst een account aan zodat we je
                    zo goed mogelijk kunnen helpen.
                </p>

                @if (Route::has('register'))
                    <div class="mt-2">
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center px-5 py-2 rounded-sm bg-[#1b1b18] text-white text-sm leading-normal hover:bg-black dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white transition-all"
                        >
                            Registreer direct en maak een afspraak
                        </a>
                    </div>
                @endif
            </section>
        </main>

        {{-- FOOTER --}}
        <footer class="w-full lg:max-w-4xl max-w-[335px] mt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A] pt-4 text-[13px] leading-[20px] text-center text-[#706f6c] dark:text-[#A1A09A]">
            @if (Route::has('register'))
                <p>
                    Nog geen account?&nbsp;
                    <a
                        href="{{ route('register') }}"
                        class="underline underline-offset-4 text-[#f53003] dark:text-[#FF4433]"
                    >
                        Registreer je hier
                    </a>
                    &nbsp;om een afspraak te kunnen maken via SmilePro.
                </p>
            @else
                <p>
                    Om een afspraak te maken via SmilePro is een account nodig.
                    Neem contact op met de praktijk als registratie nog niet is ingeschakeld.
                </p>
            @endif
        </footer>
    </body>
</html>
