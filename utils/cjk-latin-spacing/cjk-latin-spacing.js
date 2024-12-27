const CJK_START = 0x4E00;
const CJK_END = 0x9FFF;

const isCJK = (char) => {
    const code = char.charCodeAt(0);
    return code >= CJK_START && code <= CJK_END;
};

const isLatin = (char) => {
    const code = char.charCodeAt(0);
    return (
        (code >= 0x41 && code <= 0x5A) || // A-Z
        (code >= 0x61 && code <= 0x7A) || // a-z
        (code >= 0x30 && code <= 0x39)    // 0-9
    );
};

function processText(node) {
    if (node.nodeType !== Node.TEXT_NODE) {
        node.childNodes.forEach(child => processText(child));
        return;
    }

    const text = node.textContent;
    
    const result = [];
    for (let i = 0; i < text.length; i++) {
        const currentChar = text[i];
        const prevChar = text[i - 1];
        const nextChar = text[i + 1];

        result.push(currentChar);

        if (nextChar) {
            const currentIsCJK = isCJK(currentChar);
            const nextIsLatin = isLatin(nextChar);
            const currentIsLatin = isLatin(currentChar);
            const nextIsCJK = isCJK(nextChar);

            if ((currentIsCJK && nextIsLatin) || (currentIsLatin && nextIsCJK)) {
                result.push('<span class="cjk-latin-auto-space"></span>');
            }
        }

        if (currentChar === ' ' && prevChar && nextChar) {
            const prevIsCJK = isCJK(prevChar);
            const prevIsLatin = isLatin(prevChar);
            const nextIsCJK = isCJK(nextChar);
            const nextIsLatin = isLatin(nextChar);

            if ((prevIsCJK && nextIsLatin) || (prevIsLatin && nextIsCJK)) {
                result.pop();
                result.push('<span class="cjk-latin-custom-space">&nbsp;</span>');
            }
        }
    }

    const newHTML = result.join('');

    if (newHTML !== text) {
        const span = document.createElement('span');
        span.innerHTML = newHTML;
        node.parentNode.replaceChild(span, node);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, a, li, blockquote, table');
    containers.forEach(container => {
        processText(container);
    });
});
