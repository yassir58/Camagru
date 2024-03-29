
function createIcon(iconName, color, size) {
    const icon = document.createElement('i');
    icon.classList.add(iconName);
    icon.style.color = color;
    icon.style.fontSize = size;
    return icon;
}



class CommentModal extends HTMLElement {
    connectedCallback (){

        const shadow  = this.attachShadow ({mode:'open'})
        const wrapper = document.createElement ('button');
        const modalContainer = document.createElement ('div');
        const modalContent = document.createElement ('div')
        const link = document.createElement('link');
        const style = document.createElement ('link')
        const overlay = document.createElement ('div');
        const buttonContainer = document.createElement ('div')
        const submitButton = document.createElement ('button')
        const cancelButton = document.createElement ('button');
        const form = document.createElement ('form');
        const textArea = document.createElement ('textarea');
        const image_id = this.dataset.image_id


        console.log (image_id);
        form.setAttribute ('action', `/update?image_id=${image_id}`)
        form.setAttribute ('method', 'post')
        form.setAttribute ('enctype', 'multipart/form-data')
        textArea.setAttribute ('name', 'comment')
        submitButton.type ='submit'
        textArea.placeholder = 'Your Comment';
        wrapper.innerHTML = '<i class="gg-comment"></i>'
        modalContainer.classList.add ('modalContainer');
        modalContent.classList.add ('modalContent');
        overlay.classList.add ('overlay')
        modalContainer.style.width = '400px';
        submitButton.style.padding = '10px 15px';
        modalContainer.style.height = '180px';
        form.classList.add ('commmentForm');
        textArea.classList.add ('commentArea');
        cancelButton.classList.add ('darkButton');
        submitButton.classList.add ('secondaryBtn');
        submitButton.innerText = 'Submit Comment';
        cancelButton.innerText = 'cancel';
        cancelButton.style.width = '150px;'
        buttonContainer.classList.add ('buttonContainer');
        wrapper.classList.add ('smallBtn');
        style.rel = 'stylesheet';
        style.href = '/css/styles.css';
        link.rel = 'stylesheet';
        link.href = 'https://css.gg/css';

        const closeModal = ()=>{
            modalContainer.remove ();
            overlay.remove ();
        }
        overlay.addEventListener ('click', closeModal);
        cancelButton.addEventListener ('click', closeModal);
        wrapper.addEventListener ('click', ()=>{
            modalContainer.append (modalContent);
            // document.getElementById('root').appendChild (overlay);
            document.getElementById ('root').appendChild (modalContainer);
        })

        modalContent.appendChild (form);
        form.appendChild (textArea);
        buttonContainer.appendChild (submitButton);
        buttonContainer.appendChild (cancelButton);
        form.appendChild (buttonContainer);
        shadow.appendChild (style);
        shadow.appendChild (link);
        shadow.appendChild (wrapper);
    }
}


class SearchForm extends HTMLElement {
    connectedCallback (){
        const shadow = this.attachShadow({ mode: 'open' });
        const link = document.createElement('link');
        const style = document.createElement ('link');
        const searchForm = document.createElement ('form')
        const input = document.createElement ('input');
        const searchIcon = document.createElement ('i');

        style.rel = 'stylesheet';
        style.href = '/css/styles.css';
        link.rel = 'stylesheet';
        link.href = 'https://css.gg/css';
        searchForm.classList.add ('searchForm');
        searchIcon.classList.add ('gg-search')
        input.classList.add ('searchInput');
        input.placeholder = 'Search by keyword';
        searchForm.appendChild (input)
        searchForm.appendChild (searchIcon);
        shadow.appendChild (style)
        shadow.appendChild (link);
        shadow.appendChild (searchForm);
    }
}


class UploadModal extends HTMLElement {
    connectedCallback (){
        const shadow = this.attachShadow({ mode: 'open' });
        const wrapper = document.createElement ('button');
        const modalContainer = document.createElement ('div');
        const modalContent = document.createElement ('div')
        const link = document.createElement('link');
        const style = document.createElement ('link')
        const overlay = document.createElement ('div');
        const buttonContainer = document.createElement ('div')
        const uploadButton =document.createElement ('button')
        const submitButton = document.createElement ('button')
        const cancelButton = document.createElement ('button');
        const form = document.createElement ('form')
        const fileInput = document.createElement ('input');



    

        form.setAttribute ('action', '/upload')
        form.setAttribute ('method', 'post')
        form.setAttribute ('enctype', 'multipart/form-data')
        fileInput.setAttribute ('type', 'file')
        fileInput.setAttribute ('name', 'image')
        submitButton.setAttribute ('type', 'submit');
        cancelButton.innerText = 'cancel';
        cancelButton.style.cssText =   `width:100px`;
        style.rel = 'stylesheet';
        style.href = '/css/styles.css';
        link.rel = 'stylesheet';
        link.href = 'https://css.gg/css';
        buttonContainer.classList.add ('buttonContainer');


        const closeModal = ()=>{
            modalContainer.remove ();
            overlay.remove ();
        }
        overlay.addEventListener ('click', closeModal);
        cancelButton.addEventListener ('click', closeModal);
        wrapper.addEventListener ('click', ()=>{
            modalContainer.append (modalContent);
            shadow.append(overlay);
            shadow.append (modalContainer);
        })
        uploadButton.addEventListener ('click', ()=>{
            fileInput.click ();
        })
        form.appendChild (fileInput);
        form.appendChild (submitButton)
        fileInput.classList.add ("fileInput");
        uploadButton.classList.add ('uploadButton');
        uploadButton.innerHTML = '<i class="gg-software-upload"></i>';
        wrapper.classList.add ('secondaryBtn');
        submitButton.classList.add ('secondaryBtn');
        wrapper.innerHTML = '<i class="gg-software-upload"></i>'
        wrapper.style.padding = '10px 15px';
        submitButton.innerText = 'Upload';
        submitButton.style.cssText =   `width:100px; padding:10px 15px;`;
        cancelButton.classList.add ('darkButton');
        buttonContainer.appendChild (form);
        buttonContainer.appendChild (cancelButton)
        shadow.appendChild(link);
        shadow.appendChild (style);
        overlay.classList.add ('overlay') 
        modalContainer.classList.add ('modalContainer');
        modalContent.classList.add ('modalContent');
        modalContent.appendChild (uploadButton)
        modalContent.appendChild (buttonContainer);
        shadow.append (wrapper);
    }
}

class  PostCard extends HTMLElement {

    connectedCallback (){
        const shadow = this.attachShadow ({mode:'open'});
        const card = document.createElement ('div')
        const image = document.createElement ('img')
        const source = this.getAttribute ('src');
        const style = document.createElement ('link')
        const link = document.createElement ('link')
        const cardOverlay  = document.createElement ('div')
        const likeButton = document.createElement ('button')
        const commentButton = document.createElement ('comment-modal');
        const cardHeader = document.createElement ('div')
        const image_id = this.getAttribute ('image_id')


        commentButton.dataset.image_id = image_id
        link.rel='stylesheet';
        link.href = 'https://css.gg/css';
        cardOverlay.classList.add ('cardOverlay');
        likeButton.classList.add ('smallBtn');
        likeButton.innerHTML = '<i class="gg-heart"></i>'
        cardHeader.classList.add ('cardHeader')
        cardHeader.appendChild (likeButton)
        cardHeader.appendChild (commentButton)
        cardOverlay.appendChild (cardHeader);
        style.rel = 'stylesheet';
        style.href = '/css/styles.css';
        card.classList.add ('image-item');
        image.setAttribute ('src', source);
        card.appendChild (image);
        card.addEventListener ('mouseenter', ()=>{
            card.appendChild(cardOverlay);
        })
        card.addEventListener ('mouseleave', () => {
            cardOverlay.remove ()
        });
        shadow.append (style);
        shadow.append (link);
        shadow.append (card);
    }
}


class SmallButton extends HTMLElement {

    // connect component
    connectedCallback() {

    const shadow = this.attachShadow({ mode: 'open' });
    const wrapper = document.createElement ('button');
    const modalContainer = document.createElement ('div');
    const modalContent = document.createElement ('div')
    const video = document.createElement ('video')
    const snapButton = document.createElement ('button');
    const canvas = document.createElement ('canvas');
    const overlay = document.createElement ('div');    
    const buttonContainer = document.createElement ('div')
    const cancelButton = document.createElement ('button');
    const type = this.getAttribute ('type');

    console.log ('type : ', type);
        

    video.width = 250;
    video.height = 200;
    const link = document.createElement('link');
    const style = document.createElement ('link')
    style.rel = 'stylesheet';
    style.href = '/css/styles.css';
    link.rel = 'stylesheet';
    link.href = '/css/icono.min.css';
    shadow.appendChild(link);
    shadow.appendChild (style);
    snapButton.classList.add ('secondaryBtn');
    wrapper.classList.add ('secondaryBtn');
    cancelButton.classList.add ('darkButton');
    cancelButton.innerText = 'cancel';
    cancelButton.style.cssText =   `width:100px `
    snapButton.style.cssText = 'width:100px';
    buttonContainer.classList.add ('buttonContainer');
    buttonContainer.appendChild (snapButton);
    buttonContainer.appendChild (cancelButton);
    wrapper.innerHTML = `<i class='icono-camera gradient-text'/>`;
    snapButton.innerHTML = `<i class='icono-camera icon-sm'/>`;
    video.classList.add ('video');

    const closeModal = ()=>{
        modalContainer.remove ();
        overlay.remove ();
    }
    overlay.addEventListener ('click', closeModal);
    cancelButton.addEventListener ('click', closeModal);
    wrapper.addEventListener ('click', ()=>{
        navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
             console.log("An error occurred: " + err);
         });
        modalContainer.append (modalContent);
        shadow.append(overlay);
        shadow.append (modalContainer);
    })

   

snapButton.addEventListener('click', function() {
   var context = canvas.getContext('2d');
   context.drawImage(video, 0, 0, canvas.width, canvas.height);
   var imageData = canvas.toDataURL('image/png');
   var xhr = new XMLHttpRequest();
   xhr.open('POST', '/process', true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   xhr.send('imageData=' + encodeURIComponent(imageData));
});

    overlay.classList.add ('overlay') 
    modalContainer.classList.add ('modalContainer');
    modalContent.classList.add ('modalContent');
    modalContent.appendChild (video);
    modalContent.appendChild (buttonContainer);
    shadow.append (wrapper);
    shadow.removeChild
    }
  }

   
  customElements.define ('comment-modal', CommentModal);
  customElements.define ('post-card', PostCard);
  customElements.define( 'small-button', SmallButton );
  customElements.define ('upload-modal', UploadModal);
  customElements.define ('search-form', SearchForm)