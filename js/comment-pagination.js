document.addEventListener('DOMContentLoaded', () => {
    setupEventListeners()
})

function setupEventListeners()
{
    const commentPagination = document.querySelectorAll('.comment-paginate .pagination')
    const containerAllComment = document.querySelector('.container-all-comment')
    
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
                    // cara 1
                    containerAllComment.innerHTML = data

                    // cara 2
                    // containerAllComment.innerHTML = ""
                    // containerAllComment.insertAdjacentHTML('beforeend', data)

                    setupEventListeners()
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error)
                })
        })
    })
}