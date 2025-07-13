document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".status-select").forEach((select) => {
        select.addEventListener("change", function () {
            const taskId = this.dataset.taskId;
            const status = this.value;

            fetch(`/tasks/${taskId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({ status }),
            }).then((response) => {
                if (response.ok) alert("Status updated.");
            });
        });
    });
});
