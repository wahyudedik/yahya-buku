import Quill from 'quill';
import 'quill/dist/quill.snow.css';

/**
 * @returns {{ quill: Quill, textarea: HTMLTextAreaElement, syncToTextarea: () => void, getContent: () => string, setContent: (html: string) => void } | null}
 */
export function initArticleEditor(textareaId = 'writing-area') {
    const textarea = document.getElementById(textareaId);
    if (!textarea || textarea.dataset.quillInitialized === 'true') {
        return window.articleEditor ?? null;
    }

    textarea.dataset.quillInitialized = 'true';
    textarea.classList.add('hidden');

    const mount = document.createElement('div');
    mount.id = 'quill-editor-mount';
    mount.className = 'article-quill-editor rounded-lg border border-gray-300 overflow-hidden bg-white focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-transparent';
    textarea.parentNode.insertBefore(mount, textarea);

    const quill = new Quill(mount, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ indent: '-1' }, { indent: '+1' }],
                ['link', 'blockquote'],
                ['clean'],
            ],
        },
        placeholder: textarea.getAttribute('placeholder') || 'Mulai menulis...',
    });

    const syncToTextarea = () => {
        let html = quill.getSemanticHTML?.() ?? quill.root.innerHTML;
        if (html === '<p><br></p>' || html === '<p></p>') {
            html = '';
        }
        textarea.value = html;
    };

    if (textarea.value.trim()) {
        quill.clipboard.dangerouslyPasteHTML(textarea.value);
    }

    quill.on('text-change', () => {
        syncToTextarea();
        textarea.dispatchEvent(new Event('input', { bubbles: true }));
    });

    textarea.closest('form')?.addEventListener('submit', syncToTextarea);

    const instance = {
        quill,
        textarea,
        syncToTextarea,
        getContent: () => {
            syncToTextarea();

            return textarea.value;
        },
        setContent: (html) => {
            quill.setContents([]);
            if (html?.trim()) {
                quill.clipboard.dangerouslyPasteHTML(html);
            }
            syncToTextarea();
        },
        getEditorElement: () => quill.root,
    };

    window.articleEditor = instance;
    document.dispatchEvent(new CustomEvent('article-editor:ready', { detail: instance }));

    return instance;
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('writing-area')) {
        initArticleEditor();
    }
});
