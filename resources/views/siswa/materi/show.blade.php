@extends('layouts.main')

@push('css')
<style>
  .resource-tabs {
    padding: 2rem 0;
    background-color: #f8f9fa;
  }
  
  .nav-pills .nav-link {
    margin: 0 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
  }
  
  .nav-pills .nav-link.active {
    background-color: #696cff;
    box-shadow: 0 2px 4px rgba(105, 108, 255, 0.4);
  }
  
  .content-wrapper {
    max-width: 100%;
    margin: 0 auto;
  }
  
  .toc-container {
    border-radius: 8px;
    margin-bottom: 2rem;
  }
  
  .toc-nav a {
    color: #566a7f;
    text-decoration: none;
    padding: 0.5rem 0;
    display: block;
    transition: color 0.3s ease;
  }
  
  .toc-nav a:hover {
    color: #696cff;
  }
  
  .info-box {
    background-color: #f8f9fa;
    border-radius: 8px;
  }
  
  .example-box {
    border: 1px solid #e9ecef;
    border-radius: 8px;
  }
  
  .solution {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  
  .floating-nav {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
  }
  
  .floating-nav .progress-text {
    background: rgba(105, 108, 255, 0.9);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    box-shadow: 0 2px 6px rgba(105, 108, 255, 0.4);
  }
  
  .floating-nav .btn {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(105, 108, 255, 0.4);
  }
  
  @media (max-width: 768px) {
    .nav-pills .nav-link {
      margin: 0.25rem;
      padding: 0.5rem 1rem;
      font-size: 0.9rem;
    }
    
    .content-wrapper {
      padding: 1.5rem !important;
    }
  }
</style>
 <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <main>
    <!-- Reading Progress Bar -->
    <div class="progress position-fixed top-0 start-0 w-100" style="height: 3px; z-index: 1050;">
      <div id="reading-progress" class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
    </div>

    <!-- Learning Resources Tabs -->
    <section class="resource-tabs">
      <div class="container">
        <ul class="nav nav-pills mb-4 justify-content-center flex-wrap" id="resourceTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active"
              data-bs-toggle="pill"
              data-bs-target="#video-content"
            >
              <i class="fas fa-play-circle me-2"></i>Video Pembelajaran
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              data-bs-toggle="pill"
              data-bs-target="#slides-content"
            >
              <i class="fas fa-file-powerpoint me-2"></i>Slide Presentasi
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              data-bs-toggle="pill"
              data-bs-target="#text-content"
            >
              <i class="fas fa-book me-2"></i>Materi Tertulis
            </button>
          </li>
        </ul>

        <div class="tab-content" id="resourceTabContent">
          <!-- Video Content -->
          <div class="tab-pane fade show active" id="video-content">
            <div class="row justify-content-center">
              <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm">
                  <div class="ratio ratio-16x9">
                    <iframe
                      src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ"
                      title="Basic Algebra Introduction"
                      allowfullscreen
                    >
                    </iframe>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Pengenalan Aljabar Dasar</h5>
                    <p class="card-text">
                      Video pembelajaran mengenai konsep dasar aljabar dan
                      penggunaannya.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- PowerPoint Slides -->
          <div class="tab-pane fade" id="slides-content">
            <div class="row justify-content-center">
              <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm">
                  <div class="ratio ratio-16x9">
                    <iframe
                      src="https://view.officeapps.live.com/op/embed.aspx?src=https://math.berkeley.edu/~hutching/teach/54-2017/algebra.pptx"
                      frameborder="0"
                    >
                    </iframe>
                  </div>
                  <div class="card-body">
                    <div
                      class="d-flex justify-content-between align-items-center"
                    >
                      <h5 class="card-title mb-0">
                        Slide Presentasi Aljabar
                      </h5>
                      <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-download me-1"></i>Download PPT
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Text Content -->
          <div class="tab-pane fade" id="text-content">
            <div class="row justify-content-center">
              <div class="col-lg-8 col-md-10 col-12">
                <div class="content-wrapper bg-white p-4 rounded-4 shadow-sm">
                  <h1 class="mb-4">Pengenalan Aljabar</h1>

                  <!-- Table of Contents -->
                  <div class="toc-container mb-5 p-3 bg-light rounded">
                    <h5 class="mb-3">Daftar Isi</h5>
                    <nav class="toc-nav">
                      <ul class="list-unstyled">
                        <li>
                          <a href="#introduction" class="toc-link"
                            >1. Pendahuluan</a
                          >
                        </li>
                        <li>
                          <a href="#basic-concepts" class="toc-link"
                            >2. Konsep Dasar</a
                          >
                        </li>
                        <li>
                          <a href="#examples" class="toc-link"
                            >3. Contoh Soal</a
                          >
                        </li>
                        <li>
                          <a href="#practice" class="toc-link">4. Latihan</a>
                        </li>
                      </ul>
                    </nav>
                  </div>

                  <!-- Content Sections -->
                  <section id="introduction" class="mb-5">
                    <h2 class="section-title">1. Pendahuluan</h2>
                    <p class="lead">
                      Aljabar adalah cabang matematika yang mempelajari
                      hubungan antara angka, huruf, dan simbol.
                    </p>
                    <div
                      class="info-box my-4 p-3 border-start border-4 border-primary bg-light"
                    >
                      <h5>💡 Poin Penting:</h5>
                      <ul class="mb-0">
                        <li>Aljabar digunakan dalam kehidupan sehari-hari</li>
                        <li>Membantu dalam pemecahan masalah kompleks</li>
                        <li>Dasar untuk matematika tingkat lanjut</li>
                      </ul>
                    </div>
                  </section>

                  <section id="basic-concepts" class="mb-5">
                    <h2 class="section-title">2. Konsep Dasar</h2>
                    <!-- Add your content here -->
                  </section>

                  <section id="examples" class="mb-5">
                    <h2 class="section-title">3. Contoh Soal</h2>
                    <div class="example-box p-4 bg-light rounded">
                      <div class="example-item mb-4">
                        <h5>Contoh 1:</h5>
                        <p>Selesaikan persamaan: 2x + 5 = 15</p>
                        <div class="solution p-3 bg-white rounded">
                          <h6>Penyelesaian:</h6>
                          <ol>
                            <li>2x + 5 = 15</li>
                            <li>2x = 15 - 5</li>
                            <li>2x = 10</li>
                            <li>x = 5</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </section>

                  <section id="practice" class="mb-5">
                    <h2 class="section-title">4. Latihan</h2>
                    <!-- Add practice problems here -->
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Quick Navigation -->
    <div class="floating-nav">
        <div class="progress-text mb-2" id="progress-percentage">0%</div>
        <a href="{{ route('siswa.dashboard.index') }}" class="btn btn-primary rounded-circle mb-2" title="Kembali ke Dashboard">
            <i class='bx bx-home-alt'></i>
        </a>
        <button class="btn btn-primary rounded-circle" id="scrollToTop" title="Scroll to top">
            <i class='bx bx-up-arrow-alt'></i>
        </button>
    </div>
  </main>
</div>
@endsection

@push('js')
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>

<script>
  // Reading Progress
  window.addEventListener("scroll", () => {
    const winScroll = document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    document.getElementById("reading-progress").style.width = scrolled + "%";
  });

  // Smooth scroll for TOC links with offset for fixed header
  document.querySelectorAll(".toc-link").forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = link.getAttribute("href");
      const targetElement = document.querySelector(targetId);
      const headerOffset = 80;
      const elementPosition = targetElement.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
      
      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth"
      });
    });
  });

  // Scroll to top functionality with smooth animation
  const scrollToTopBtn = document.getElementById("scrollToTop");
  
  window.addEventListener("scroll", () => {
    if (window.pageYOffset > 300) {
      scrollToTopBtn.style.display = "flex";
    } else {
      scrollToTopBtn.style.display = "none";
    }
  });
  
  scrollToTopBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  // Update progress percentage with throttling
  let ticking = false;
  window.addEventListener("scroll", () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        const winScroll = document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = Math.round((winScroll / height) * 100);
        const progressElement = document.getElementById("progress-percentage");
        if (progressElement) {
          progressElement.textContent = `${scrolled}%`;
        }
        ticking = false;
      });
      ticking = true;
    }
  });
</script>
@endpush