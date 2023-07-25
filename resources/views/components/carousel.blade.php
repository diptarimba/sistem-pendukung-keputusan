<div class="owl-carousel">
    @foreach ($content as $eachContent)
        <div>
            <img src="{{ $eachContent }}" class="d-block w-100" alt="...">
        </div>
    @endforeach
</div>

@push('footer-carrier')
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            items: 1, // Tampilkan hanya 1 item/gambar dalam satu waktu
            loop: true, // Ulangi carousel setelah mencapai slide terakhir
            autoplay: true, // Otomatis ganti slide
            autoplayTimeout: 2000, // Waktu tunggu sebelum slide berpindah (dalam milidetik)
            autoplayHoverPause: true, // Jika pengguna mengarahkan kursor ke carousel, hentikan autoplay
        });
    });
</script>
@endpush
