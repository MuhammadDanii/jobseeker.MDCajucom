<section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
    <div class="overlay"></div>
    <div class="container mx-auto text-center z-10">
        <h1 class="text-4xl text-white font-bold mb-4">Find Your Dream Job</h1>
        
        <form id="searchForm" action="/listings" method="GET" class="mb-4 block mx-5 md:mx-auto">
            
            <span style="position: relative; display: inline-block;" class="w-full md:w-auto mb-2">
                <input
                    id="keywordsInput"
                    type="text"
                    name="keywords"
                    placeholder="Keywords"
                    value="<?= htmlspecialchars($_GET['keywords'] ?? '') ?>"
                    class="w-full md:w-auto px-4 py-2 focus:outline-none" style="padding-right: 2rem;" />
                <button type="button" id="clearKeywords" class="hidden" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; font-size: 1.25rem; cursor: pointer; font-weight: bold; padding: 0;">&times;</button>
            </span>

            <span style="position: relative; display: inline-block;" class="w-full md:w-auto mb-2">
                <input
                    id="locationInput"
                    type="text"
                    name="location"
                    placeholder="Location"
                    value="<?= htmlspecialchars($_GET['location'] ?? '') ?>"
                    class="w-full md:w-auto px-4 py-2 focus:outline-none" style="padding-right: 2rem;" />
                <button type="button" id="clearLocation" class="hidden" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; font-size: 1.25rem; cursor: pointer; font-weight: bold; padding: 0;">&times;</button>
            </span>

            <button
                type="submit"
                style="background-color: #0cb5a0;"
                class="w-full md:w-auto text-black font-bold mb-2 px-4 py-2 focus:outline-none transition hover:opacity-95">
                <i class="fa fa-search"></i> Search
            </button>

            <button
                type="button"
                id="clearBothBtn"
                class="w-full md:w-auto bg-white text-gray-700 border border-gray-300 font-bold mb-2 px-4 py-2 focus:outline-none transition hover:bg-gray-50">
                Clear All
            </button>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const keywordsInput = document.getElementById('keywordsInput');
    const locationInput = document.getElementById('locationInput');
    const clearKeywords = document.getElementById('clearKeywords');
    const clearLocation = document.getElementById('clearLocation');
    const clearBothBtn = document.getElementById('clearBothBtn');

    function toggleXButton(input, button) {
        if (input.value.trim().length > 0) {
            button.style.display = 'inline-block';
        } else {
            button.style.display = 'none';
        }
    }

    keywordsInput.addEventListener('input', () => toggleXButton(keywordsInput, clearKeywords));
    locationInput.addEventListener('input', () => toggleXButton(locationInput, clearLocation));

    // Run initial check on load
    toggleXButton(keywordsInput, clearKeywords);
    toggleXButton(locationInput, clearLocation);

    clearKeywords.addEventListener('click', function() {
        keywordsInput.value = '';
        this.style.display = 'none';
        keywordsInput.focus();
    });

    clearLocation.addEventListener('click', function() {
        locationInput.value = '';
        this.style.display = 'none';
        locationInput.focus();
    });

    clearBothBtn.addEventListener('click', function() {
        keywordsInput.value = '';
        locationInput.value = '';
        clearKeywords.style.display = 'none';
        clearLocation.style.display = 'none';
        keywordsInput.focus();
    });
});
</script>