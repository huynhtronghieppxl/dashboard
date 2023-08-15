if (CKEDITOR.env.ie && CKEDITOR.env.version < 9) CKEDITOR.tools.enableHtml5Elements(document);

CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';

/**
 * @param id = element string
 **/

  function ckEditorTemplate(id) {
    for (let i = 0; i < id.length; i++) {
        let wysiwygareaAvailable = isWysiwygareaAvailable();

        let editorElement = CKEDITOR.document.getById(id[i]);

        if (wysiwygareaAvailable) {
            CKEDITOR.replace(id[i]);
        } else {
            editorElement.setAttribute('contenteditable', 'true');
            CKEDITOR.inline(id[i]);
        }
    }
}

function isWysiwygareaAvailable() {
    if (CKEDITOR.revision == ('%RE' + 'V%')) {
        return true;
    }
    return !!CKEDITOR.plugins.get('wysiwygarea');
}

