<section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
    <div class="overlay"></div>
    <div class="container mx-auto text-center z-10">
        <h1 class="text-4xl text-white font-bold mb-4">Find Your Dream Job</h1>
        
        <form id="searchForm" action="/listings" method="GET" class="mb-4 flex flex-col md:flex-row items-center justify-center gap-2 mx-5 md:mx-auto max-w-4xl">
            
            <div class="relative w-full md:w-64">
                <input
                    id="keywordsInput"
                    type="text"
                    name="keywords"
                    placeholder="Keywords"
                    value="<?= htmlspecialchars($_GET['keywords'] ?? '') ?>"
                    class="w-full px-4 py-2 pr-8 focus:outline-none rounded-l-md md:rounded-none" />
                <button 
                    type="button" 
                    id="clearKeywords" 
                    class="hidden absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 font-bold focus:outline-none text-lg">
                    &times;
                </button>
            </div>

            <div class="relative w-full md:w-64">
                <input
                    id="locationInput"
                    type="text"
                    name="location"
                    placeholder="Location"
                    value="<?= htmlspecialchars($_GET['location'] ?? '') ?>"
                    class="w-full px-4 py-2 pr-8 focus:outline-none" />
                <button 
                    type="button" 
                    id="clearLocation" 
                    class="hidden absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 font-bold focus:outline-none text-lg">
                    &times;
                </button>
            </div>

            <div class="flex w-full md:w-auto gap-2">
                <button
                    type="submit"
                    style="background-color: #0cb5a0;"
                    class="w-full md:w-auto text-black font-semibold px-5 py-2 rounded-r-md md:rounded-none focus:outline-none shadow-sm transition hover:opacity-90">
                    <i class="fa fa-search"></i> Search
                </button>

                <button
                    type="button"
                    id="clearBothBtn"
                    class="w-full md:w-auto bg-white text-gray-700 border border-gray-300 font-semibold px-4 py-2 rounded-md focus:outline-none shadow-sm transition hover:bg-gray-50">
                    Clear All
                </button>
            </div>
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

    // Toggle visibility helper function based on length
    function toggleXButton(input, button) {
        if (input.value.trim().length > 0) {
            button.classList.remove('hidden');
        } else {
            button.classList.add('hidden');
        }
    }

    // Monitor input modifications
    keywordsInput.addEventListener('input', () => toggleXButton(keywordsInput, clearKeywords));
    locationInput.addEventListener('input', () => toggleXButton(locationInput, clearLocation));

    // Initialize visibility states on page load (if search values are already present)
    toggleXButton(keywordsInput, clearKeywords);
    toggleXButton(locationInput, clearLocation);

    // Individual clearing logic for Keywords
    clearKeywords.addEventListener('click', function() {
        keywordsInput.value = '';
        this.classList.add('hidden');
        keywordsInput.focus();
    });

    // Individual clearing logic for Location
    clearLocation.addEventListener('click', function() {
        locationInput.value = '';
        this.classList.add('hidden');
        locationInput.focus();
    });

    // Global Clear Both Button Logic
    clearBothBtn.addEventListener('click', function() {
        keywordsInput.value = '';
        locationInput.value = '';
        clearKeywords.add('hidden');
        clearLocation.add('hidden');
    });
});
</script>