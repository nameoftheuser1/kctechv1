function confirmDelete(formId, entityName = 'item') {
    if (confirm(`Are you sure you want to delete this ${entityName}?`)) {
        document.getElementById(formId).submit();
    }
}
