document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function() {
            const imgElement = this.parentElement.previousElementSibling.previousElementSibling.firstElementChild;
            const link = imgElement.src;
            navigator.clipboard.writeText(link).then(() => {
                alert('API链接已复制：' + link);
            }).catch(err => {
                alert('复制失败：', err);
            });
        });
    });

    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            const category = this.parentElement.previousElementSibling.previousElementSibling.firstElementChild.alt.split('类')[0];
            window.location.href = `gallery.html?category=${category.toLowerCase()}`;
        });
    });
});
