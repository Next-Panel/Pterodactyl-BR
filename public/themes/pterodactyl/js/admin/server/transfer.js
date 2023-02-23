$(document).ready(function () {
    $('#pNodeId').select2({
        placeholder: 'Selecione um Node',
    }).change();

    $('#pAllocation').select2({
        placeholder: 'Selecione uma Alocação Padrão',
    });

    $('#pAllocationAdditional').select2({
        placeholder: 'Selecione Alocações Adicionais',
    });
});

$('#pNodeId').on('change', function () {
    let currentNode = $(this).val();

    $.each(Pterodactyl.nodeData, function (i, v) {
        if (v.id == currentNode) {
            $('#pAllocation').html('').select2({
                data: v.allocations,
                placeholder: 'Selecione uma Alocação Padrão',
            });

            updateAdditionalAllocations();
        }
    });
});

$('#pAllocation').on('change', function () {
    updateAdditionalAllocations();
});

function updateAdditionalAllocations() {
    let currentAllocation = $('#pAllocation').val();
    let currentNode = $('#pNodeId').val();

    $.each(Pterodactyl.nodeData, function (i, v) {
        if (v.id == currentNode) {
            let allocations = [];

            for (let i = 0; i < v.allocations.length; i++) {
                const allocation = v.allocations[i];

                if (allocation.id != currentAllocation) {
                    allocations.push(allocation);
                }
            }

            $('#pAllocationAdditional').html('').select2({
                data: allocations,
                placeholder: 'Selecione Alocações Adicionais',
            });
        }
    });
}
