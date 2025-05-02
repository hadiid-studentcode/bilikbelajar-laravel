  
@if(!request()->is('siswa/kuis*') && !request()->is('siswa/evaluasi*'))
  <footer class="content-footer footer bg-footer-theme ">
      <div class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
          <div class="mb-2 mb-md-0">
              ©
              <script>
                  document.write(new Date().getFullYear());
              </script>
              , BilikBelajar |  by
              <a href="#" target="_blank" class="footer-link fw-bolder">Zahra Ramadhani</a>
          </div>
         
      </div>
  </footer>
  @endif
