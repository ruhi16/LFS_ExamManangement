<!DOCTYPE html>
<html>

<head>
    <title>Simple Modal Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @livewireStyles
</head>

<body>
    <div style="padding: 20px;">
        <h1>Simple Modal Test</h1>
        <div id="debug-info" style="background: yellow; padding: 10px; margin: 10px 0; border: 2px solid orange;">
            <strong>Debug Info:</strong>
            <div id="modal-count">Checking for modals...</div>
        </div>
        @livewire('user-role-comp')
    </div>
    @livewireScripts

    <script>
        function checkModals() {
            const roleModals = document.querySelectorAll('[style*="z-index: 9999"]');
            const testModals = document.querySelectorAll('[style*="z-index: 99999"]');
            const allModals = document.querySelectorAll('[class*="fixed"], [style*="position: fixed"]');

            document.getElementById('modal-count').innerHTML = `
                Role Modals (z-index 9999): ${roleModals.length}<br>
                Test Modals (z-index 99999): ${testModals.length}<br>
                All Fixed Elements: ${allModals.length}<br>
                <button onclick="highlightModals()" style="background: red; color: white; padding: 5px;">Highlight Modals</button>
            `;
        }

        function highlightModals() {
            const allFixed = document.querySelectorAll('[class*="fixed"], [style*="position: fixed"]');
            allFixed.forEach((el, index) => {
                el.style.border = '5px solid lime';
                el.style.boxShadow = '0 0 20px lime';
                console.log(`Modal ${index}:`, el);
            });
        }

        // Check every 2 seconds
        setInterval(checkModals, 2000);

        // Initial check
        setTimeout(checkModals, 1000);

        // Livewire event listeners
        document.addEventListener('livewire:load', function () {
            console.log('✅ Livewire loaded');
            checkModals();
        });

        document.addEventListener('livewire:update', function () {
            console.log('🔄 Livewire updated');
            checkModals();
        });
    </script>
</body>

</html>