// Fungsi JavaScript untuk menampilkan form reply yang sesuai
document.addEventListener('DOMContentLoaded', function() {
    const replyButtons = document.querySelectorAll('.btn-reply');
    const batalButtons = document.querySelectorAll('.btn-batal');

    replyButtons.forEach((button) => {
        button.addEventListener('click', function() {
            // Dapatkan data-comment-id dari tombol "balas" yang ditekan
            const commentId = button.getAttribute('data-comment-id');

            // Cari elemen form reply yang sesuai berdasarkan data-comment-id
            const replyForm = document.querySelector(`.comment-reply[data-comment-id="${commentId}"]`);


            // Tampilkan form reply jika sebelumnya disembunyikan, atau sembunyikan jika sebelumnya ditampilkan
            replyForm.style.display = replyForm.style.display == 'none' ? 'flex' : 'none';
        });
    });

    // batalButtons.forEach(batal => {
    //     batal.addEventListener(("click"), ()=> {
    //         this.innerText = this.innerText == 'Balas' ? 'Batal' : 'Balas';
    //     }   
    // });
});
