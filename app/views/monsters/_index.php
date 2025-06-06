<section class="mb-20">
    <h2 class="text-2xl font-bold mb-4 creepster"><?php echo $title; ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php if (empty($monsters)): ?>
            <p class="text-red-500">Aucun monstre trouvé. Testez d'autres filtres.</p>
        <?php endif; ?>
        <!-- Monster Item -->
         <?php foreach($monsters as $monster): ?>
        <article
            class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 monster-card"
            data-monster-type="spectral">
            <img
            class="w-full h-48 object-cover rounded-t-lg"
            src="../public/images/<?php echo $monster['image_url']; ?>"
            alt="<?php echo $monster['name']; ?>"/>
            <div class="p-4">
            <h3 class="text-xl font-bold"><?php echo $monster['monster_name']; ?></h3>
            <h4 class="mb-2">
                <a href="#" class="text-red-400 hover:underline"
                >Alex Smith</a>
            </h4>
            <p class="text-gray-300 text-sm mb-2">
                <?php echo $monster['description']; ?>
            </p>
            <div class="flex justify-between items-center mb-2">
                <div>
                <span class="text-yellow-400">★★★★☆</span>
                <span class="text-gray-300 text-sm">(4.0/5.0)</span>
                </div>
                <span class="text-sm text-gray-300">Type: <?php echo $monster['type_name']; ?></span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm text-gray-300">PV: <?php echo $monster['pv']; ?></span>
                <span class="text-sm text-gray-300">Attaque: <?php echo $monster['attack']; ?></span>
            </div>
            <div class="text-center">
                <a
                href="?monsters=show&id=<?php echo $monster['monsterId']; ?>"
                class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
                >Plus de détails</a>
            </div>
            </div>
            <div class="absolute top-4 right-4">
            <button
                class="text-white bg-gray-400 hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
                style="
                width: 40px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                ">
                <i class="fa fa-bookmark"></i>
            </button>
            </div>
        </article>
        <?php endforeach; ?>
        <!-- Répétez pour d'autres monstres -->
    </div>
</section>
<!-- <p>test avant pagination</p> -->
 <!-- bien checker si totalPages existe car j'utilise la meme vue pour plusieurs routes. cela evite les erreur venu d'autre action sur cette meme vue qui ne possède pas totalpage ou page -->
<?php if (isset($totalPages) && $totalPages > 1): ?>
    <!-- <p>Test après pagination</p> -->
    <nav class="flex justify-center mt-8">
        <ul class="flex gap-2">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li>
                    <a href="?monsters&page=<?php echo $i; ?>"
                    class="px-3 py-2 border <?php echo $i == $page ? 'bg-red-500 text-white' : 'bg-gray-700 text-gray-300'; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>