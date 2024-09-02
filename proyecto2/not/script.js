const apiUrl = 'news.php';

function addNews() {
    const title = document.getElementById('news-title').value;
    const content = document.getElementById('news-content').value;
    const image = document.getElementById('news-image').files[0];
    
    const formData = new FormData();
    formData.append('action', 'add');
    formData.append('title', title);
    formData.append('content', content);
    if (image) {
        formData.append('image', image);
    }

    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            fetchNews();
            clearForm();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function editNews(id, title, content, imageUrl) {
    document.getElementById('news-title').value = title;
    document.getElementById('news-content').value = content;
    // Puedes manejar la vista previa de la imagen si es necesario.

    // Elimina la noticia existente para poder reemplazarla
    deleteNews(id, () => {
        addNews();
    });
}

function deleteNews(id, callback) {
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('id', id);

    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (callback) callback();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function fetchNews() {
    const formData = new FormData();
    formData.append('action', 'list');
    
    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const newsListContainer = document.getElementById('news-list');
        newsListContainer.innerHTML = '';

        data.forEach(news => {
            const newsElement = document.createElement('div');
            newsElement.classList.add('news-item');
            newsElement.innerHTML = `
                <h2>${news.titulo}</h2>
                <p>${news.contenido}</p>
                ${news.imagen ? `<img src="uploads/${news.imagen}" alt="Imagen de la noticia">` : ''}
                <button onclick="editNews(${news.id}, '${news.titulo}', '${news.contenido}', '${news.imagen}')">Editar</button>
                <button onclick="deleteNews(${news.id})">Ocultar</button>
            `;
            newsListContainer.appendChild(newsElement);
        });
    })
    .catch(error => console.error('Error:', error));
}

function clearForm() {
    document.getElementById('news-title').value = '';
    document.getElementById('news-content').value = '';
    document.getElementById('news-image').value = '';
}

// Cargar noticias al inicio
fetchNews();
