document.addEventListener("DOMContentLoaded", function() {
    let waitMsg = document.createElement('h1');
    waitMsg.innerHTML = "Please, wait...";
    document.body.appendChild(waitMsg);
    let canvas = document.createElement('canvas');
    canvas.setAttribute('id', 'collage');
    canvas.width = 800;
    canvas.height = 600;
    document.body.appendChild(canvas);
    cross = {
        x: Math.round(1 / 3 * canvas.width + Math.random() * 1 / 3 * canvas.width),
        y: Math.round(1 / 3 * canvas.height + Math.random() * 1 / 3 * canvas.height),
    }
    console.log(cross);
    var ctx = canvas.getContext("2d");
    ctx.filter = "drop-shadow(10px 10px 10px)";
    photoSizes = [
        [cross.x, cross.y],
        [canvas.width - cross.x, cross.y],
        [cross.x, canvas.height - cross.y],
        [canvas.width - cross.x, canvas.height - cross.y],
    ]
    photoPins = [
        [0, 0],
        [cross.x, 0],
        [0, cross.y],
        [cross.x, cross.y],
    ]
    Promise.all(photoSizes.map(getPhoto))
        .then(photos => {
            for (let i = 0; i < photos.length; i++) {
                photos[i].pin = photoPins[i];
            }
            Promise.all(photos.map((photo) => {
                let img = new Image();
                console.log(photo.url, photo.pin[0], photo.pin[1]);
                img.onload = function() {
                    ctx.drawImage(img, photo.pin[0], photo.pin[1]);
                }
                img.crossOrigin = 'anonymous';
                img.src = photo.url;
            }));
        }).then(() => {
        return getQuote()
            .then((response) => {
                if (response.ok)
                    return response.text();
                else
                    throw new Error(response.status + ": " + response.statusText);
            })
            .then((quote) => {
                console.log(quote);
                quoteLengthPX = ctx.measureText(quote).width;
                ctx.font = "italic bold 30px Georgia";
                ctx.fillStyle = '#ffffff';
                ctx.textAlign = 'center';
                const words = quote.split(' ');
                let line = "";
                let lines = [];
                for (let i = 0; i < words.length; i++) {
                    let testLine = line + words[i] + " ";
                    let testWidth = ctx.measureText(testLine).width;
                    if (testWidth > 4 / 5 * canvas.width) {
                        lines.push(line);
                        line = words[i] + " ";
                    } else {
                        line = testLine;
                    }
                }
                lines.push(line);
                const lineHeight = 35;
                let marginTop = canvas.height / 2 - lines.length / 2 * lineHeight;
                for (let i = 0; i < lines.length; i++) {
                    ctx.fillText(lines[i], canvas.width / 2, marginTop);
                    marginTop += lineHeight;
                }
            })
            .catch((err) => console.error(err));
    }).then(() => {
        waitMsg.hidden = 'true';
        var dataURL = canvas.toDataURL("image/png");
        var link = document.createElement("a");
        link.innerHTML = "Download";
        link.href = dataURL;
        link.download = new Date().getTime();
        document.body.appendChild(link);
    });
});

let getQuote = function() {
    return fetch('http://fizmatspb.ru/itmoweb/lab3/requester.php');
}

let getPhoto = function(photoSize) {
    const photoWidth = photoSize[0],
        photoHeight = photoSize[1];
    const numImagesAvailable = 105;
    let randomImageIndex = Math.floor(Math.random() * numImagesAvailable);
    return fetch(`https://source.unsplash.com/collection/656243/${photoWidth}x${photoHeight}/?sig=${randomImageIndex}`);
}