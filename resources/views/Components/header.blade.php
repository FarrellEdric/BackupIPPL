@vite('resources/css/app.css')

<style>
  .simply-button {
    cursor: pointer;
    color: black;
    background-color: grey;
    opacity: 0.7;
    transition: 0.3s ease;
    padding: 13px 28px;
    border-radius: 4px;
    border: 2px solid black;
  }

  .simply-button:hover {
    opacity: 1;
  }

  /* tombol nempel di kanan atas layar meskipun zoom */
  .fixed-login {
    position: fixed;
    top: 5px;
    right: 25px;
    z-index: 9999;
    border-radius: 8px;
  }
</style>

<!-- ========== MAIN CONTENT ========== -->
<main id="content">
  <!-- Secondary Navbar -->
  <div class="md:py-4 bg-white md:border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
    <nav class="relative max-w-[85rem] w-full mx-auto md:flex md:items-center md:gap-3 px-4 sm:px-6 lg:px-8">
      <!-- Collapse -->
      <div id="hs-secondaru-navbar"
        class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block"
        aria-labelledby="hs-secondaru-navbar-collapse">
        <div
          class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
          <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center gap-y-0.5 md:gap-y-0 md:gap-x-6">

            <a href="/home"
              class="py-2 md:py-0 flex items-center font-medium text-sm
    {{ request()->is('home') ? 'text-blue-600 dark:text-blue-500' : 'text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500' }}"
              style="font-size: 22px">
              <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" ...></svg>
              Dashboard
            </a>

            <a href="/booking"
              class="py-2 md:py-0 flex items-center font-medium text-sm
    {{ request()->is('booking') ? 'text-blue-600 dark:text-blue-500' : 'text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500' }}"
              style="font-size: 22px">
              <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" ...></svg>
              Booking
            </a>


            <a class="py-2 md:py-0 flex items-center font-medium text-sm
    {{ request()->is('managements') ? 'text-blue-600 dark:text-blue-500' : 'text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500' }}"
              href="/managements" style="font-size: 22px">
              <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 12h.01" />
                <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                <rect width="20" height="14" x="2" y="6" rx="2" />
              </svg>
              Managements
            </a>

          </div>
        </div>
      </div>
      <!-- End Collapse -->
    </nav>
  </div>

  <!-- Tombol login tetap di pojok -->
  <div class="fixed-login">
    <button class="simply-button">Login</button>
  </div>

  <!-- End Secondary Navbar -->
</main>