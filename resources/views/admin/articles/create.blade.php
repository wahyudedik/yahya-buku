<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tulis Artikel Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" id="ruang-tulisan-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold transition-colors duration-300" id="page-title">Ruang Tulisan</h1>
                    <div class="flex gap-2">
                        <!-- Settings button removed as requested -->
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition">
                            Simpan Artikel
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content / Articles List -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Writing Workspace -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 transition-colors duration-300" id="workspace-card">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1 setting-label">Judul Artikel</label>
                                <input type="text" name="title" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan judul artikel..." required>
                            </div>

                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold transition-colors duration-300" id="workspace-title">Konten Artikel</h2>
                                <span id="save-status" class="text-xs text-gray-500 italic transition-colors duration-300"></span>
                            </div>
                            <textarea id="writing-area" name="content" class="w-full h-96 p-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y transition-all duration-300" placeholder="Mulai menulis ide atau draft artikel Anda di sini..." required></textarea>
                        </div>
                    </div>

                    <!-- Sidebar / Settings Panel & Meta -->
                    <div class="space-y-6">
                        <!-- Meta Data -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="font-bold text-gray-900 mb-4">Informasi Publikasi</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kutipan Singkat (Excerpt)</label>
                                <textarea name="excerpt" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>
                        </div>

                        <!-- Settings Panel (Hidden by default on mobile, can be toggled) -->
                        <div id="settings-panel" class="hidden bg-white shadow-2xl lg:shadow-sm lg:border lg:border-gray-100 rounded-xl p-6 fixed inset-y-0 right-0 w-80 z-50 lg:relative lg:w-auto lg:inset-auto lg:block lg:transform-none transform translate-x-full transition-transform duration-300">
                            <div class="flex justify-between items-center mb-4 lg:hidden">
                                <h3 class="text-lg font-bold text-gray-900">Pengaturan Tampilan</h3>
                                <button type="button" onclick="toggleSettings()" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            
                            <!-- Theme -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-3 setting-label">Tema Editor</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <button type="button" onclick="setTheme('light')" class="p-2 border rounded-lg hover:border-blue-500 focus:ring-2 focus:ring-blue-500 flex flex-col items-center gap-1 theme-btn" data-theme="light">
                                        <div class="w-full h-8 bg-gray-50 border rounded"></div>
                                        <span class="text-xs">Terang</span>
                                    </button>
                                    <button type="button" onclick="setTheme('sepia')" class="p-2 border rounded-lg hover:border-blue-500 focus:ring-2 focus:ring-blue-500 flex flex-col items-center gap-1 theme-btn" data-theme="sepia">
                                        <div class="w-full h-8 bg-[#f4ecd8] border rounded"></div>
                                        <span class="text-xs">Sepia</span>
                                    </button>
                                    <button type="button" onclick="setTheme('dark')" class="p-2 border rounded-lg hover:border-blue-500 focus:ring-2 focus:ring-blue-500 flex flex-col items-center gap-1 theme-btn" data-theme="dark">
                                        <div class="w-full h-8 bg-gray-900 border rounded"></div>
                                        <span class="text-xs">Gelap</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Typography -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-3 setting-label">Tipografi</label>
                                
                                <div class="mb-4">
                                    <label class="text-xs text-gray-500 mb-1 block setting-sublabel">Jenis Font</label>
                                    <select id="font-family" onchange="setFontFamily(this.value)" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        <option value="font-sans">Sans Serif (Default)</option>
                                        <option value="font-serif">Serif (Klasik)</option>
                                        <option value="font-mono">Monospace (Coding)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block setting-sublabel">Ukuran Font</label>
                                    <input type="range" id="font-size" min="14" max="24" step="1" value="16" oninput="setFontSize(this.value)" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>Kecil</span>
                                        <span id="font-size-display">16px</span>
                                        <span>Besar</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Auto Save -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-3 setting-label">Fitur Auto-Save</label>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-gray-600 setting-text">Aktifkan</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="autosave-toggle" class="sr-only peer" onchange="toggleAutoSave(this.checked)">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                
                                <div id="autosave-interval-container" class="transition-opacity duration-300">
                                    <label class="text-xs text-gray-500 mb-1 block setting-sublabel">Interval (detik)</label>
                                    <select id="autosave-interval" onchange="setAutoSaveInterval(this.value)" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        <option value="5000">5 Detik</option>
                                        <option value="15000">15 Detik</option>
                                        <option value="30000">30 Detik</option>
                                        <option value="60000">1 Menit</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Reset -->
                            <div class="pt-4 border-t border-gray-200">
                                <button type="button" onclick="resetSettings()" class="w-full px-4 py-2 border border-red-200 text-red-600 rounded-lg text-sm hover:bg-red-50 transition">
                                    Reset Pengaturan Tampilan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebar-overlay" onclick="toggleSettings()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <script>
        // Configuration State
        const defaultConfig = {
            theme: 'light',
            fontFamily: 'font-sans',
            fontSize: '16',
            autoSave: true,
            autoSaveInterval: '15000',
            content: ''
        };

        let config = { ...defaultConfig };
        let autoSaveTimer = null;

        // Initialization
        document.addEventListener('DOMContentLoaded', () => {
            loadSettings();
            applySettings();
            initAutoSave();
        });

        // UI Functions
        function toggleSettings() {
            const panel = document.getElementById('settings-panel');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (panel.classList.contains('translate-x-full')) {
                panel.classList.remove('translate-x-full');
                panel.classList.remove('hidden'); // Ensure visible
                overlay.classList.remove('hidden');
            } else {
                panel.classList.add('translate-x-full');
                // Use timeout to hide after transition if needed, but for simplicity:
                // overlay.classList.add('hidden');
                // For desktop (lg:relative), translate doesn't affect visibility much unless we handle classes carefully.
                // The current class setup handles mobile fixed vs desktop relative.
                // But for mobile toggle:
                if (window.innerWidth < 1024) {
                    overlay.classList.add('hidden');
                }
            }
        }

        // Logic Functions
        function loadSettings() {
            const savedConfig = localStorage.getItem('ruangTulisanConfig');
            if (savedConfig) {
                config = { ...defaultConfig, ...JSON.parse(savedConfig) };
            }
            
            // Sync UI inputs with config
            document.getElementById('font-family').value = config.fontFamily;
            document.getElementById('font-size').value = config.fontSize;
            document.getElementById('font-size-display').innerText = config.fontSize + 'px';
            document.getElementById('autosave-toggle').checked = config.autoSave;
            document.getElementById('autosave-interval').value = config.autoSaveInterval;
            // Note: We don't restore content automatically to the textarea because this is a create form, 
            // unless we want to restore a draft. Let's assume we do for "auto-save draft" feature.
            // But be careful not to overwrite if editing existing.
            // For 'create', we can restore draft.
            if (!document.getElementById('writing-area').value && config.content) {
                document.getElementById('writing-area').value = config.content;
            }
            
            updateAutoSaveUI();
        }

        function saveConfig() {
            localStorage.setItem('ruangTulisanConfig', JSON.stringify(config));
        }

        function applySettings() {
            const container = document.getElementById('ruang-tulisan-container');
            const workspace = document.getElementById('writing-area');
            const titles = document.querySelectorAll('h1, h2, h3, #page-title, #workspace-title');
            const texts = document.querySelectorAll('.setting-label, .setting-text, #save-status');
            const cards = document.querySelectorAll('#workspace-card'); // Only style workspace card with theme, leave meta card white/default for admin consistency? Or style all? Let's style workspace mainly.
            
            // Apply Theme
            if (config.theme === 'dark') {
                // container.classList.add('bg-gray-900'); // Admin layout handles bg, maybe just darken workspace area?
                // Actually admin layout usually has gray-100 bg. Let's just style the workspace card.
                
                cards.forEach(c => {
                    c.classList.remove('bg-white', 'bg-[#fdf6e3]', 'border-gray-100');
                    c.classList.add('bg-gray-800', 'border-gray-700');
                });

                workspace.classList.remove('bg-white', 'text-gray-900');
                workspace.classList.add('bg-gray-700', 'text-white', 'border-gray-600');

            } else if (config.theme === 'sepia') {
                cards.forEach(c => {
                    c.classList.remove('bg-white', 'bg-gray-800', 'border-gray-700', 'border-gray-100');
                    c.classList.add('bg-[#fdf6e3]', 'border-[#e0d6c0]');
                });

                workspace.classList.remove('bg-white', 'bg-gray-700', 'text-white', 'text-gray-900');
                workspace.classList.add('bg-[#fdf6e3]', 'text-[#5f4b32]', 'border-[#e0d6c0]');

            } else {
                // Light
                cards.forEach(c => {
                    c.classList.remove('bg-gray-800', 'bg-[#fdf6e3]', 'border-gray-700', 'border-[#e0d6c0]');
                    c.classList.add('bg-white', 'border-gray-100');
                });

                workspace.classList.remove('bg-gray-700', 'bg-[#fdf6e3]', 'text-white', 'text-[#5f4b32]', 'border-gray-600', 'border-[#e0d6c0]');
                workspace.classList.add('bg-white', 'text-gray-900');
            }

            // Active state for theme buttons
            document.querySelectorAll('.theme-btn').forEach(btn => {
                if(btn.dataset.theme === config.theme) {
                    btn.classList.add('ring-2', 'ring-blue-500', 'border-blue-500');
                } else {
                    btn.classList.remove('ring-2', 'ring-blue-500', 'border-blue-500');
                }
            });

            // Apply Font Family
            const fontClasses = ['font-sans', 'font-serif', 'font-mono'];
            workspace.classList.remove(...fontClasses);
            workspace.classList.add(config.fontFamily);

            // Apply Font Size
            workspace.style.fontSize = `${config.fontSize}px`;
        }

        // Setting Setters
        function setTheme(theme) {
            config.theme = theme;
            saveConfig();
            applySettings();
        }

        function setFontFamily(family) {
            config.fontFamily = family;
            saveConfig();
            applySettings();
        }

        function setFontSize(size) {
            config.fontSize = size;
            document.getElementById('font-size-display').innerText = size + 'px';
            saveConfig();
            applySettings();
        }

        // Auto Save Logic
        function toggleAutoSave(enabled) {
            config.autoSave = enabled;
            saveConfig();
            updateAutoSaveUI();
            initAutoSave();
        }

        function setAutoSaveInterval(interval) {
            config.autoSaveInterval = interval;
            saveConfig();
            initAutoSave(); 
        }

        function updateAutoSaveUI() {
            const container = document.getElementById('autosave-interval-container');
            if (config.autoSave) {
                container.classList.remove('opacity-50', 'pointer-events-none');
            } else {
                container.classList.add('opacity-50', 'pointer-events-none');
            }
        }

        function initAutoSave() {
            if (autoSaveTimer) clearInterval(autoSaveTimer);
            
            if (config.autoSave) {
                autoSaveTimer = setInterval(() => {
                    const content = document.getElementById('writing-area').value;
                    // Save to local storage as draft
                    if (content !== config.content) {
                        config.content = content;
                        saveConfig();
                        showSaveStatus('Draft tersimpan di browser');
                    }
                }, parseInt(config.autoSaveInterval));
            }
        }

        document.getElementById('writing-area').addEventListener('input', (e) => {
            showSaveStatus('Mengetik...');
        });

        function showSaveStatus(msg) {
            const statusEl = document.getElementById('save-status');
            statusEl.innerText = msg;
            if (msg.includes('tersimpan')) {
                setTimeout(() => {
                    statusEl.innerText = '';
                }, 2000);
            }
        }

        function resetSettings() {
            if(confirm('Reset pengaturan tampilan ke default?')) {
                const currentContent = document.getElementById('writing-area').value;
                config = { ...defaultConfig };
                config.content = currentContent; // Keep content
                
                saveConfig();
                
                document.getElementById('font-family').value = config.fontFamily;
                document.getElementById('font-size').value = config.fontSize;
                document.getElementById('font-size-display').innerText = config.fontSize + 'px';
                document.getElementById('autosave-toggle').checked = config.autoSave;
                document.getElementById('autosave-interval').value = config.autoSaveInterval;
                
                applySettings();
                initAutoSave();
                updateAutoSaveUI();
            }
        }
    </script>
</x-app-layout>