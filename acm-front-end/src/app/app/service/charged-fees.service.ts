import { HttpClientModule, HttpClient, HttpEvent, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ChargedFees } from '../model/charged-fees.model';
import { Observable, throwError } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class ChargedFeesService {
	private _chargedFeesUrl = 'acm-back-end/api/charged_fees';
  

    constructor(private _httpClient: HttpClient) {
    }

    createChargedFees(chargedFees: ChargedFees): Observable<any> {
    	return this._httpClient.post(this._chargedFeesUrl, toFormData(chargedFees));
    }

    getChargedFees(): Observable<any> {
      return this._httpClient.get(this._chargedFeesUrl);
    }
}

export function toFormData<ChargedFees>( formValue: ChargedFees ) {
  const formData = new FormData();

  for ( const key of Object.keys(formValue) ) {
    const value = formValue[key];
    formData.append(key, value);
  }

  return formData;
}