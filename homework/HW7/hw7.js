top_img = "cluster"
img_src = new Array("cluster", "interacting", "m51", "m104", "ngc1300", "ngc6217")
img_caption = new Array ("Galaxy Cluster", "Interacting galaxies", "M51",
"M 104", "NGC 1300", "NGC 6217")

function getImage() {
    rnd_index = Math.trunc(Math.random() * img_src.length)
    return img_src[rnd_index]
}

function changeImg() {
    new_img = getImage()
    styleTop = document.getElementById(top_img).style
    styleNew = document.getElementById(new_img).style

    styleTop.zIndex = "0"
    styleNew.zIndex = "10"
    top_img = new_img

    updateCaption(new_img)
}

function updateCaption(new_img) {
    index = img_src.indexOf(new_img)
    caption = document.getElementById("text")
    caption.textContent = img_caption[index]
}