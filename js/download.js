function downloadCvAsPdf() {
    const cvId = this.closest('.cv-card').getAttribute('data-cv-id');
    fetch(`cv.php?cv_id=${cvId}`)
        .then(response => response.text())
        .then(html => {
            const jsPDF = window.jspdf.jsPDF;
            const doc = new jsPDF();
            doc.html(html, {
                callback: function (doc) {
                    doc.save(`CV-${cvId}.pdf`);
                },
                x: 1,
                y: 1
            });
        })
        .catch(error => console.error('Error downloading CV:', error));
}