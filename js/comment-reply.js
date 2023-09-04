// Fungsi JavaScript untuk menampilkan form reply yang sesuai
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector(".container-comments");
    // const batalButtons = document.querySelectorAll('.btn-batal'); 

    container.addEventListener('click', function(e) {
        if(e.target.className == 'lipatan')
        {
            if(e.target.children[1].innerHTML == "⤵")
            {
                e.target.children[1].innerHTML = "&#x2934;"
            }
            else 
            {
                e.target.children[1].innerHTML = "&#x2935;";
            }
            e.target.nextElementSibling.classList.toggle("hidden")

            let textNode = e.target.firstChild
            if(textNode !== null)
            {
                if(textNode && textNode.nodeType === Node.TEXT_NODE)
                {
                    if(textNode.textContent == "Lihat balasan")
                    {
                        textNode.textContent = "Sembunyikan balasan"
                    }
                    else 
                    {
                        textNode.textContent = "Lihat balasan"
                    }
                }
            }
        }
        if(e.target.className == 'btn-reply')
        {
            const commentId = e.target.dataset.commentId
            const commentBox = document.querySelector(`.comment-box[data-comment-id="${commentId}"]`)
            const commentReply = document.querySelector(`.comment-reply[data-comment-id="${commentId}"]`)
            const lipatan = document.querySelector(`.lipatan[data-comment-id="${commentId}"]`)

            e.target.style.backgroundColor = "inherit"
            e.target.style.color = "#aaa"
            e.target.style.borderColor = "#aaa"
            commentBox.classList.remove('hidden')
            if(e.target.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling !== null)
            {
                e.target.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.style.display = 'flex'
            }
            else
            {
                e.target.parentElement.parentElement.nextElementSibling.nextElementSibling.style.display = 'flex'
            }

            commentReply.scrollIntoView({behavior: "smooth"})

            let textLipatan = lipatan.firstChild
            if(textLipatan !== null)
            {
                if(textLipatan && textLipatan.nodeType === Node.TEXT_NODE)
                {
                    if(textLipatan.textContent == "Lihat balasan")
                    {
                        textLipatan.textContent = "Sembunyikan balasan"
                    }
                }
            }
        }
        if(e.target.classList.contains('btn-batal'))
        {
            const commentId = e.target.dataset.commentId

            const commentBox = document.querySelector(`.comment-box[data-comment-id="${commentId}"]`)
            const commentReply = document.querySelector(`.comment-reply[data-comment-id="${commentId}"]`)
            const btnReply = document.querySelector(`.btn-reply[data-comment-id="${commentId}"]`)
            const lipatan = document.querySelector(`.lipatan[data-comment-id="${commentId}"]`)
            const kolomComment = document.querySelector(`.kolom-comment[data-comment-id="${commentId}"]`)

            
            kolomComment.scrollIntoView({behavior: "smooth"})
            setTimeout(function(){
                commentBox.classList.add("hidden")
            }, 500)
            commentReply.style.display = "none"
            btnReply.style.backgroundColor = "revert-layer"
            btnReply.style.color = "revert-layer"
            btnReply.style.border = "revert-layer"

            let textLipatan = lipatan.firstChild
            if(textLipatan !== null)
            {
                if(textLipatan && textLipatan.nodeType === Node.TEXT_NODE)
                {
                    if(textLipatan.textContent == "Sembunyikan balasan")
                    {
                        textLipatan.textContent = "Lihat balasan"
                    }
                }
            }
        }
    })
})