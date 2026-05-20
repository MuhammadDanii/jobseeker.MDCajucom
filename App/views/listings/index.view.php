<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('showcase-search') ?>
<?php loadPartial('top-banner') ?>

<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3 bg-white rounded-md shadow-sm">
            <?php if (!empty($_GET['keywords']) || !empty($_GET['location'])): ?>
                Search Results For: 
                <span class="text-indigo-600">
                    <?= !empty($_GET['keywords']) ? '"' . htmlspecialchars($_GET['keywords']) . '"' : '' ?>
                </span>
                <?= !empty($_GET['keywords']) && !empty($_GET['location']) ? ' in ' : '' ?>
                <span class="text-indigo-600">
                    <?= !empty($_GET['location']) ? '"' . htmlspecialchars($_GET['location']) . '"' : '' ?>
                </span>
            <?php else: ?>
                All Jobs
            <?php endif; ?>
        </div>
        
        <?php if (!empty($listings)): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <?php foreach ($listings as $listing): ?>
                    <div class="rounded-lg shadow-md bg-white">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold">
                                <a href="/listing/<?= $listing->id ?>" class="text-indigo-600 hover:text-indigo-800">
                                    <?= htmlspecialchars($listing->title) ?>
                                </a>
                            </h2>
                            <p class="text-gray-700 text-lg mt-2">
                                <?= htmlspecialchars($listing->description) ?>
                            </p>
                            <ul class="my-4 bg-gray-100 p-4 rounded">
                                <li class="mb-2"><strong>Salary:</strong> <?= formatSalary($listing->salary) ?></li>
                                <li class="mb-2">
                                    <strong>Location:</strong> <?= htmlspecialchars($listing->city) ?>, <?= htmlspecialchars($listing->state) ?>
                                </li>
                                <li class="mb-2 flex flex-wrap items-center gap-2">
                                    <strong class="mr-1">Tags:</strong> 
                                    <?php if (!empty($listing->tags)): ?>
                                        <?php 
                                            $tagsArray = array_map('trim', explode(',', $listing->tags)); 
                                            foreach ($tagsArray as $tag) : 
                                        ?>
                                            <span class="text-sm bg-white text-gray-800 border border-gray-300 rounded-md px-3 py-1 font-semibold shadow-sm">
                                                <?= htmlspecialchars($tag) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <span class="text-gray-400 italic text-sm">None</span>
                                    <?php endif; ?>
                                </li>
                            </ul>
                            <a href="/listing/<?= $listing->id ?>"
                                class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                                Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-yellow-50 border border-yellow-200 text-center p-12 rounded-lg shadow-sm my-6">
                <i class="fa fa-briefcase text-4xl text-yellow-400 mb-3 block"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-1">No Jobs Found</h3>
                <p class="text-gray-600">We couldn't find any job listings matching your specific search criteria. Try clearing filters or using different keywords.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php loadPartial('bottom-banner') ?>
<?php loadPartial('footer'); ?>