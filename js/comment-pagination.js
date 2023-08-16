document.addEventListener('DOMContentLoaded', () => {
    const commentPagination = document.querySelectorAll('.comment-paginate .pagination')
    const containerComment = document.querySelector('.container-comments')

    commentPagination.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault()

            const targetUrl = this.getAttribute('href')

            fetch(targetUrl)
                .then(response => {
                    if(!response.ok) {
                        throw new Error('Gagal melakukan permintaan.')
                    }
                    return response.text()
                })
                .then(data => {
                    console.log(data)
                    containerComment.innerHTML = data
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error)
                })
        })
    });
})