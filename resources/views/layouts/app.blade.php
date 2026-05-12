<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            {{-- @livewire('navigation-menu') --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow header-top">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Remove the old hardcoded header-time if any
                document.querySelectorAll('.header-time, .top-info').forEach(el => el.remove());

                // Find all page headers
                const headers = document.querySelectorAll('.header-top, .page-header, .topbar');
                
                headers.forEach(header => {
                    // Create new universal top-right clock
                    const clockDiv = document.createElement('div');
                    clockDiv.className = 'header-time';
                    clockDiv.style.display = 'flex';
                    clockDiv.style.gap = '20px';
                    clockDiv.style.alignItems = 'center';
                    clockDiv.style.color = '#475569';
                    clockDiv.style.fontSize = '14px';
                    clockDiv.style.fontWeight = '600';
                    clockDiv.innerHTML = `
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span style="font-size:16px;">🗓️</span> <span class="live-date">...</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span style="font-size:16px;">🕒</span> <span class="live-time">...</span>
                        </div>
                    `;
                    
                    // Ensure the header behaves as a flex container to push the clock to the right
                    header.style.display = 'flex';
                    header.style.justifyContent = 'space-between';
                    header.style.alignItems = 'center';
                    
                    header.appendChild(clockDiv);
                });

                setInterval(function() {
                    const now = new Date();
                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    const dateStr = days[now.getDay()] + ', ' + String(now.getDate()).padStart(2, '0') + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
                    const timeStr = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0') + ':' + String(now.getSeconds()).padStart(2, '0') + ' WIB';
                    
                    document.querySelectorAll('.live-date').forEach(el => el.innerText = dateStr);
                    document.querySelectorAll('.live-time').forEach(el => el.innerText = timeStr);
                }, 1000);
            });
        </script>
    </body>
</html>
