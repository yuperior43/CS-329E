p = document.getElementsByTagName("p")
console.log(p)

for (i=0; i<p.length; i++) {
  p[i].innerHTML = "<strong>Paragraph " + i + ". </strong>" + p[i].innerHTML
}
