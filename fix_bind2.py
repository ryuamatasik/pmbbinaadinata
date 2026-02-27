import re

files = [
    "c:/xampp/htdocs/pmbbinaadinata/resources/views/mahasiswa/pendaftaran.blade.php"
]

for file_path in files:
    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    # Replace old('field') with old('field', $pendaftar->field ?? '')
    content = re.sub(
        r"old\('([^']+)'\)", 
        lambda m: f"old('{m.group(1)}', $pendaftar->{m.group(1)} ?? '')", 
        content
    )

    # Replace old('field', 'default') with old('field', $pendaftar->field ?? 'default')
    # only matches if the second argument is a string literal starting with a single quote
    content = re.sub(
        r"old\('([^']+)',\s*('[^']+)'\)", 
        lambda m: f"old('{m.group(1)}', $pendaftar->{m.group(1)} ?? {m.group(2)})", 
        content
    )

    with open(file_path, "w", encoding="utf-8") as f:
        f.write(content)

print("Updated " + file_path)
