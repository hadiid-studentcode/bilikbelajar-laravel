  
@if(!request()->is('siswa/kuis*'))
  <footer class="content-footer footer bg-footer-theme ">
      <div class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
          <div class="mb-2 mb-md-0">
              ©
              <script>
                  document.write(new Date().getFullYear());
              </script>
              , BilikBelajar |  by
              <a href="https://creativecode5.vercel.app/" target="_blank" class="footer-link fw-bolder">CreativeCode5</a>
          </div>
         
      </div>
  </footer>
  @endif
