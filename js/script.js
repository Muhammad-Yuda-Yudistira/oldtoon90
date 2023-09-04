const containerStream = document.querySelector('.container-stream')
const streaming = document.querySelector('.streaming')
const subTitle = document.querySelector('.sub-title')

const like = document.querySelector('#like')
const nostalgia = document.querySelector('#nostalgia')
const nilai = document.querySelector('.nilai')
const watched = document.querySelector('#watched')

const baseurl = "http://localhost/2023/mei/oldtoon90/"


document.addEventListener('DOMContentLoaded', function() {
    // Tempatkan seluruh kode JavaScript Anda di sini
    streaming.addEventListener('play', () => {
        streaming.volume = .65
        containerStream.style.backgroundColor = "#333" 
        subTitle.style.color = "#47A992"
    })

    streaming.addEventListener('pause', () => 
        containerStream.style.backgroundColor = "#eee"
    )

    if(watched.dataset.watched > 0) 
    {
        watched.style.fill = "#7A3E3E"
    }

    
        streaming.addEventListener('ended', function() {
    
            const xhr = new XMLHttpRequest();
            xhr.open('GET', baseurl + 'ui/templates/user/helper/watched.php?eps=' + watched.dataset.eps, true);
            xhr.onload = function()
            {
                if(xhr.status == 200)
                {
                    const response = xhr.responseText;
    
                    nilai.innerHTML = response;
                    watched.style.fill = "#7A3E3E"
                }
            }
            xhr.send()
        })
   

    if(like.dataset.hasLike == true)
    {
        like.classList.add('change-value')
    }

    if(like.dataset.user)
    {
        like.addEventListener('click', function() {
    
            const xhr = new XMLHttpRequest()
            xhr.open('GET', baseurl + 'ui/templates/user/helper/like.php?eps=' + like.dataset.eps, true)
            xhr.onload = function()
            {
                if(xhr.status == 200)
                {
                    const response = xhr.responseText
                    like.nextElementSibling.innerHTML = response
                
                    like.classList.toggle('change-value')
                }
            }
            xhr.send()
            return
        })
    }


    if(nostalgia.dataset.hasNostalgia == true)
    {
        nostalgia.classList.add('change-value')
    }

    if(nostalgia.dataset.user)
    {
        nostalgia.addEventListener('click', function() {
    
            const xhr = new XMLHttpRequest()
            xhr.open('GET', baseurl + 'ui/templates/user/helper/nostalgia.php?eps=' + nostalgia.dataset.eps, true)
            xhr.onload = function()
            {
                if(xhr.status == 200)
                {
                    const response = xhr.responseText;
                    nostalgia.nextElementSibling.innerHTML = response
                    
                    nostalgia.classList.toggle('change-value')
                }
            }
            xhr.send()
        })   
    }


});
