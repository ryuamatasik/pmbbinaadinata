import re

file_path = "c:/xampp/htdocs/pmbbinaadinata/resources/views/mahasiswa/partials/modal-keluarga.blade.php"

with open(file_path, "r", encoding="utf-8") as f:
    content = f.read()

# Replace old('field') with old('field', $pendaftar->field ?? '')
content = re.sub(
    r"old\('([^']+)'\)", 
    lambda m: f"old('{m.group(1)}', $pendaftar->{m.group(1)} ?? '')", 
    content
)

# Replace old('field', 'default') with old('field', $pendaftar->field ?? 'default')
# Wait, the first regex won't match old('field', 'default') because of the comma.
content = re.sub(
    r"old\('([^']+)',\s*('[^']+)'\)", 
    lambda m: f"old('{m.group(1)}', $pendaftar->{m.group(1)} ?? {m.group(2)})", 
    content
)

with open(file_path, "w", encoding="utf-8") as f:
    f.write(content)

print("Updated modal-keluarga.blade.php")
