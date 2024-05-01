#/
import os

base_url = "https://edenestatesmw.com/"
dir_path = "static_html/"

# Get all file names in the directory
file_names = os.listdir(dir_path)

# Filter out non-html files
html_files = [f for f in file_names if f.endswith('.html')]

# Generate XML for each html file
for file in html_files:
    # Remove .html extension and replace spaces with hyphens
    page_name = file[:-5].replace(' ', '-')
    print(f"""
    <url>
        <loc>{base_url}{page_name}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    """)
