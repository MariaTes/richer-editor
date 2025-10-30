window.toggleRichEditorFullscreen = (rootElement) => {
    rootElement.classList.toggle('fullscreen');
    rootElement.querySelector('.fullscreen-toggle').classList.toggle('fi-active');

    // add escape key listener to exit fullscreen
    const escFunction = function(event) {
        if (event.key === "Escape") {
            rootElement.classList.remove('fullscreen');
            rootElement.querySelector('.fullscreen-toggle').classList.remove('fi-active');
            document.removeEventListener("keydown", escFunction);
        }
    }

    if (rootElement.classList.contains('fullscreen')) {
        document.addEventListener("keydown", escFunction);
        rootElement.setAttribute('tabindex', '-1');
        rootElement.focus();
    } else {
        rootElement.removeAttribute('tabindex');
    }
}
