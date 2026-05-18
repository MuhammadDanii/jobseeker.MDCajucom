<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
        
        <form action="/listings/update/<?= $listing->id ?>" method="POST">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Job Info</h2>
            
            <div class="mb-4">
                <input type="text" name="title" value="<?= htmlspecialchars($listing->title) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <textarea name="description" class="w-full px-4 py-2 border rounded focus:outline-none" required><?= htmlspecialchars($listing->description) ?></textarea>
            </div>
            <div class="mb-4">
                <input type="text" name="salary" value="<?= htmlspecialchars($listing->salary) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            <div class="mb-4">
                <input type="text" name="tags" value="<?= htmlspecialchars($listing->tags ?? '') ?>" class="w-full px-4 py-2 border rounded focus:outline-none" placeholder="Tags (Comma-separated)" />
            </div>
            <div class="mb-4">
                <input type="text" name="requirements" value="<?= htmlspecialchars($listing->requirements) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            <div class="mb-4">
                <input type="text" name="benefits" value="<?= htmlspecialchars($listing->benefits) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Company Info & Location</h2>
            
            <div class="mb-4">
                <input type="text" name="company" value="<?= htmlspecialchars($listing->company) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="address" value="<?= htmlspecialchars($listing->address) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            <div class="mb-4">
                <input type="text" name="city" value="<?= htmlspecialchars($listing->city) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            <div class="mb-4">
                <input type="text" name="state" value="<?= htmlspecialchars($listing->state) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            <div class="mb-4">
                <input type="text" name="phone" value="<?= htmlspecialchars($listing->phone) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            <div class="mb-4">
                <input type="email" name="email" value="<?= htmlspecialchars($listing->email) ?>" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Update Listing
            </button>
            <a href="/listing/<?= $listing->id ?>" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
                Cancel
            </a>
        </form>
    </div>
</section>
<br><br>

<?php loadPartial('footer-home'); ?>