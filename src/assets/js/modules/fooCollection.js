import $ from "jquery";

let scrollEventListenerThirdArgument = false;
(() => {
    try {
        let options = Object.defineProperty({}, "passive", {
            get: () => {
                scrollEventListenerThirdArgument = {passive: true};
            }
        });
        window.addEventListener("test", null, options);
    } catch(err) {}
})();

export {scrollEventListenerThirdArgument};

const querySelectorAsArray = (selector, context = document) => Array.prototype.slice.call(context.querySelectorAll(selector));
export {querySelectorAsArray};

function makeCount(wrapper, plus, minus, result) {
    let countCell = document.querySelectorAll(wrapper);
    if (countCell.length) {

        for (var i = 0; i < countCell.length; i++) {
            countCell[i].addEventListener('click', function (e) {
                let target   = e.target,
                    count    = this.querySelector(result),
                    countInt = parseInt(count.innerText),
                    resultInt;

                if ( target.classList.contains(plus) ) {
                    resultInt = countInt + 1;
                    count.innerText = resultInt.toString();
                } else if ( target.classList.contains(minus) && countInt > 1 ) {
                    resultInt = countInt - 1;
                    count.innerText = resultInt.toString();
                }
            })
        }
    }
};

function findParent(element, parentClass) {
    let currentEl = element,
        body      = document.body;

    do {
        currentEl = currentEl.parentNode;

        if ( currentEl.classList.contains(parentClass) ) {
            return currentEl;
        } else if (currentEl === body) {
            break
        }
    } while ( !currentEl.classList.contains(parentClass) )
};

function closeModals() {
    $('.modal').removeClass('active')
}

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var f = files[0];
    // Only process image files.
    if (!f.type.match('image.*')) {
        alert("Только картинки, пожалуйста.");
    }
    var reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {
            // Render thumbnail.
            var span = document.createElement('span');
            span.innerHTML = ['<img class="form__load-img" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
            document.getElementById('output').insertBefore(span, null);
        };
    })(f);
    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
}



function emailValid(email) {
    function emailRegExp () {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    }

    return emailRegExp().test(email);
}

export default {
    makeCount,
    findParent,
    closeModals,
    handleFileSelect
}