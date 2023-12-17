  <!-- Footer -->
  <footer class="content-footer footer bg-footer-theme">
    {{-- <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
      <div class="mb-2 mb-md-0">
        ©
        <script>
          document.write(new Date().getFullYear());
        </script>
        , Copyright to
        <a href="https://panacea.live" target="_blank" class="footer-link fw-bolder">Panacea Live Ltd</a>
      </div>
    </div> --}}

    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            ©
            <script>
              document.write(new Date().getFullYear());
            </script>
            Copyright to
            <a href="https://panacea.live" target="_blank" class="footer-link fw-bolder">Panacea Live Ltd</a> <br>
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>


  </footer>
  <!-- / Footer -->
