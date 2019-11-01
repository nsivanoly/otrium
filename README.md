# Otrium Challenge #1
Attached (in the e-mail) you’ll find a SQL file with two tables containing dummy data:
- Brands: containing data of fictive brands.
- GMV: containing the total turnover per day for all brands.

The challenge is to create a script that will generate a table inside a CSV file with at least the following data:
- Turnover per brand (all brands)
- Turnover per day (of all brands)
- Scope: data should only contain the first 7 days of the month May (01-05-2018 - 07-05-2018).

End result: the end result should be a single table (inside a single CSV file) containing the aforementioned data. CSV
needs to be easy to read/analyse for a person on a daily basis.

Bonus: the prices in the database are 21% VAT included. Bonus task is:
- Show the excluded VAT per brand as well (21%)

## Developer Notes
- Used Laravel 5.8
- Migration created with relationship
- Model created with relationship [Eloquent ORM]
- Make use of Services, Repositories, Requests
- Sample admin dashboard with datatable
- Export csv via ajax.
- Module bundler [webpack]