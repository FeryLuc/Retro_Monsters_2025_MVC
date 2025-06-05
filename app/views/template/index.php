<!DOCTYPE html>
<html lang="fr">
  <head>
     <?php include_once '../app/views/template/partials/_head.php'; ?>
  </head>
  <body class="bg-gray-800 text-white font-sans">
    <!-- Header -->
    <header
      class="bg-gray-900 shadow-lg relative top-8"
      x-data="{ open: false, loggedIn: true, userMenuOpen: false }">
      <?php include_once '../app/views/template/partials/_header.php'; ?>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto flex flex-wrap pt-4 pb-12">
      <main class="w-full md:w-3/4 p-4">
        <?php include_once '../app/views/template/partials/_main.php'; ?>
      </main>

      <!-- Sidebar -->
      <aside class="w-full md:w-1/4 p-4">
        <?php include_once '../app/views/template/partials/_aside.php'; ?>
      </aside>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8">
      <?php include_once '../app/views/template/partials/_footer.php'; ?>
    </footer>
  </body>
</html>
