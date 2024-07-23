function downloadCvAsPdf() {
    const cvId = this.closest('.cv-card').getAttribute('data-cv-id');
    fetch(`cv.php?cv_id=${cvId}`)
        .then(response => response.text())
        .then(html => {
            const jsPDF = window.jspdf.jsPDF;
            const doc = new jsPDF();
            
            const link = document.createElement('link');
            link.href = 'css/cv.css';
            link.rel = 'stylesheet';
            document.head.appendChild(link);
            
            doc.html(html, {
                callback: function (doc) {
                    doc.save(`CV-${cvId}.pdf`);
                    location.reload();
                },
                x: 10,
                y: 10,
                windowWidth: 1000 

            });
        })
        .catch(error => console.error('Error downloading CV:', error));
}
